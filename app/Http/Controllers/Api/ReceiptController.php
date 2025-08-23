<?php
namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\BloodStock;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Receipt;
use App\Models\ReceiptDetail;

class ReceiptController extends ApiBaseController {

    public function detail(int $id, Request $request) {
        try {
            $data = Receipt::select([
                'penerimaan.*',
                'pengambil.name AS pengambil',
                'penerima.name AS penerima',
                'pemeriksa.name AS pemeriksa'
            ])
                ->where('pemesanan_id', $id)
                ->leftJoin('users AS pengambil', 'pengambil.id', 'penerimaan.ambil_sampel_oleh')
                ->leftJoin('users AS penerima', 'penerima.id', 'penerimaan.terima_sampel_oleh')
                ->leftJoin('users AS pemeriksa', 'pemeriksa.id', 'penerimaan.periksa_sampel_oleh')
                ->first();

            if (empty($data)) {
                throw new \Exception('No Order Data Found');
            }
            return $this->successApiResponse($data);

        } catch (\Exception $e) {
            return $this->errorApiResponse(500, $e->getMessage());
        }
    }

    public function create(Request $request) {
        try {
            $orderId = $request->order_id;

            $order = Order::find($orderId);
            if (empty($order)) {
                throw new \Exception('No Order Data Found');
            }

            $data = Receipt::where('pemesanan_id', $order->id)
                ->first();

            if (empty($data)) {
                $data = Receipt::create([
                    "pemesanan_id" => $order->id,
                    "kode_penerimaan" => 'P/'.date('Y/m').'/'.substr(strtotime('NOW'), -5),
                    "tgl_penerimaan" => date('Y-m-d'),
                    "status" => 0,
                    "created_by" => auth()->user()->id,
                    "updated_by" => auth()->user()->id
                ]);
                $order->status = 2;
                $order->save();
            }

            return $this->successApiResponse($data);

        } catch (\Exception $e) {
            return $this->errorApiResponse(500, $e->getMessage());
        }
    }

    public function process(int $id, Request $request) {
        try {

            $order = Order::where('id', $request->order_id)->first();

            if (in_array($order->status, [0, 5])) {
                throw new \Exception('Pemesanan sudah Selesai/ Di tolak');
            }
            if ($order->tipe == 'bdrs') {
                $data = $this->bdrs($id, $request, $order);
            } else {
                $data = $this->nonBdrs($id, $request, $order);
            }

            if (is_string($data)) {
                throw new \Exception($data);
            }
            return $this->successApiResponse($data);

        } catch (\Exception $e) {
            return $this->errorApiResponse(500, $e->getMessage());
        }
    }

    public function detailItem(int $id, Request $request) {
        try {

            $data = ReceiptDetail::select([
                'penerimaan_detail.id',
                'penerimaan_detail.harga',
                'blood_stock.stock_no',
                'blood_stock.expiry_date',
                'blood_stock.blood_group',
                'blood_stock.blood_rhesus',
                'blood_stock.unit_volume',
                'blood.name',
                'blood.blood_type',
            ])
                ->join('blood_stock', 'blood_stock.id', '=', 'penerimaan_detail.blood_stock_id')
                ->join('blood', 'blood_stock.blood_id', '=', 'blood.id')
                ->where('pemesanan_detail_id', $id)
                ->get();

            return $this->successApiResponse($data);

        } catch (\Exception $e) {
            return $this->errorApiResponse(500, $e->getMessage());
        }
    }

    public function payment($id, Request $request) {
        try {

            $data = Order::find($id);
            if (!$data || empty($data)) {
                throw new \Exception('Data is not found');
            }

            $data->status = 5;
            $data->updated_by = auth()->user()->id;
            $data->save();

            $updateReceipt = Receipt::where('pemesanan_id', $id)
                ->first();

            $updateReceipt->status = 4;
            $updateReceipt->updated_by = auth()->user()->id;
            $updateReceipt->save();

            $updateReceiptDetail = ReceiptDetail::where('penerimaan_id', $updateReceipt->id)
                ->update([
                    'status' => 4,
                    'updated_by' => auth()->user()->id
                ]);

            return $this->successApiResponse($data);

        } catch (\Exception $e) {
            return $this->errorApiResponse(500, $e->getMessage());
        }
    }

    private function bdrs(int $id, Request $request, Order $order) {
        $type = 4;
        $items = json_decode($request->items);
        $totalHarga = 0;

        if (count($items) <= 0) {
            return "Item penerimaan tidak boleh kosong";
        }
        
        if (count($items) > 0) {
            $orderDetailId = array_map(function($i) {
                return $i->pemesanan_detail_id;
            }, $items);
            
            $total = OrderDetail::selectRaw('SUM(jumlah_ml * jumlah) AS total_ml')
                ->whereIn('id', $orderDetailId)
                ->first();

            $totalMl = $total->total_ml ?? 0;

            $proposedQty = array_sum(array_map(fn($i) => $i->unit_volume, $items));

            if ($proposedQty != $totalMl) {
                return "Total item tidak sama dengan total permintaan";
            }

            $totalSisa = $totalMl;
            foreach ($items as $item) {
                $totalSisa = $totalSisa - $item->unit_volume;
                $totalHarga = $totalHarga + $item->harga;

                ReceiptDetail::create([
                    'penerimaan_id' => $id,
                    'pemesanan_detail_id' => $item->pemesanan_detail_id,
                    'blood_stock_id' => $item->id,
                    'sisa' => $totalSisa,
                    'harga' => $item->harga,
                    'status' => $item->status,
                ]);

                BloodStock::where('id', $item->id)
                    ->update(['status' => 2]);
            }

            $data = Receipt::where('id', $id)
                ->update([ 
                    'status' => $type,
                    'total_harga' => $totalHarga,
                ]);
        }

        $order->status = 4;
        $order->save();

        return true;
    }
    private function nonBdrs(int $id, Request $request, Order $order) {
        $user = auth()->user();

        $processStatus = [
            'ambil_sampel' => [
                'status' => 1,
                'tgl_ambil_sampel' => date('Y-m-d'),
                'jam_ambil_sampel' => date('H:i:s'),
                'ambil_sampel_oleh' => $user->id,
            ], 
            'terima_sampel' => [
                'status' => 2,
                'tgl_terima_sampel' => date('Y-m-d'),
                'jam_terima_sampel' => date('H:i:s'),
                'terima_sampel_oleh' => $user->id,
            ], 
            'periksa_sampel' => [
                'status' => 3,
                'tgl_periksa_sampel' => date('Y-m-d'),
                'jam_periksa_sampel' => date('H:i:s'),
                'periksa_sampel_oleh' => $user->id,
                'hasil_pemeriksaan' => $request->hasil_pemeriksaan,
                'hasil_golongan_sampel' => $request->hasil_golongan_sampel,
                'hasil_rhesus_sampel' => $request->hasil_rhesus_sampel
            ],
            'selesai' => [
                'status' => 4,
            ],
        ];

        $type = $request->type;
        $items = json_decode($request->items);
        $totalSisa = 0;
        $totalHarga = 0;

        if ($type == 'periksa_sampel') {
            if ($request->hasil_pemeriksaan == 0) {
                $data = Receipt::where('id', $id)
                    ->update([
                        'status' => 0,
                        'tgl_ambil_sampel' => '',
                        'jam_ambil_sampel' => '',
                        'ambil_sampel_oleh' => '',
                        'tgl_terima_sampel' => '',
                        'jam_terima_sampel' => '',
                        'terima_sampel_oleh' => '',
                        "updated_by" => auth()->user()->id
                    ]);

                return "Hasil Pemeriksaan tidak cocok, harap kirimkan sample kembali";
            }
            
            if (count($items) <= 0) {
                return "Item penerimaan tidak boleh kosong";
            }
        }
        
        if (count($items) > 0) {
            $orderDetailId = array_map(function($i) {
                return $i->pemesanan_detail_id;
            }, $items);
            $total = OrderDetail::selectRaw('SUM(jumlah_ml * jumlah) AS total_ml')
                ->whereIn('id', $orderDetailId)
                ->first();

            $totalMl = $total->total_ml ?? 0;

            $proposedQty = array_sum(array_map(fn($i) => ($i->unit_volume), $items));

            if ($proposedQty != $totalMl) {
                return "Total item tidak sama dengan total permintaan";
            }

            $totalSisa = $totalMl;
            foreach ($items as $item) {
                $totalSisa = $totalSisa - $item->unit_volume;
                $totalHarga = $totalHarga + $item->harga;

                ReceiptDetail::create([
                    'penerimaan_id' => $id,
                    'pemesanan_detail_id' => $item->pemesanan_detail_id,
                    'blood_stock_id' => $item->id,
                    'sisa' => $totalSisa,
                    'harga' => $item->harga,
                    'status' => $item->status,
                ]);

                BloodStock::where('id', $item->id)
                    ->update(['status' => 2]);
            }
        }

        $data = Receipt::where('id', $id)
            ->update(array_merge($processStatus[$type], ['total_harga' => $totalHarga]));

        $order->status = $totalSisa > 0 ? 5 : 2;
        $order->save();

        $orderStatusArr = [
            'ambil_sampel' => 3,
            'terima_sampel' => 3,
            'periksa_sampel' => 4,
            'selesai' => 5,
        ];

        $order->status = $orderStatusArr[$type];
        $order->save();

        return true;
    }
}