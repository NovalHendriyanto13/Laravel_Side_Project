<?php
namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Receipt;

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
            if ($order->tipe == 'bdrs') {
                throw new \Exception('Transaksi tipe adalah BDRS, silakan isi stok');
            }

            $processStatus = [
                'ambil_sampel' => [
                    'status' => 1,
                    'tgl_ambil_sampel' => date('Y-m-d'),
                    'jam_ambil_sampel' => date('H:i:s'),
                    'ambil_sampel_oleh' => auth()->user()->id,
                ], 
                'terima_sampel' => [
                    'status' => 2,
                    'tgl_terima_sampel' => date('Y-m-d'),
                    'jam_terima_sampel' => date('H:i:s'),
                    'terima_sampel_oleh' => auth()->user()->id,
                ], 
                'periksa_sampel' => [
                    'status' => 3,
                    'tgl_periksa_sampel' => date('Y-m-d'),
                    'jam_periksa_sampel' => date('H:i:s'),
                    'periksa_sampel_oleh' => auth()->user()->id,
                    'hasil_pemeriksaan' => $request->hasil_pemeriksaan,
                    'hasil_golongan_sampel' => $request->hasil_golongan_sampel,
                    'hasil_rhesus_sampel' => $request->hasil_rhesus_sampel
                ],
            ];

            $type = $request->type;

            $data = Receipt::where('id', $id)
                ->update($processStatus[$type]);

            $orderStatusArr = [
                'ambil_sampel' => 3,
                'terima_sampel' => 3,
                'periksa_sampel' => 4,
            ];

            $order->status = $orderStatusArr[$type];
            $order->save();

            return $this->successApiResponse($data);

        } catch (\Exception $e) {
            return $this->errorApiResponse(500, $e->getMessage());
        }
    }

    public function processBdrs(int $id, Request $request) {
        try {

            $order = Order::where('id', $request->order_id)->first();
            if ($order->tipe == 'bdrs') {
                throw new \Exception('Transaksi tipe adalah BDRS, silakan isi stok');
            }

            $processStatus = [
                'ambil_sampel' => [
                    'status' => 1,
                    'tgl_ambil_sampel' => date('Y-m-d'),
                    'jam_ambil_sampel' => date('H:i:s'),
                    'ambil_sampel_oleh' => auth()->user()->id,
                ], 
                'terima_sampel' => [
                    'status' => 2,
                    'tgl_terima_sampel' => date('Y-m-d'),
                    'jam_terima_sampel' => date('H:i:s'),
                    'terima_sampel_oleh' => auth()->user()->id,
                ], 
                'periksa_sampel' => [
                    'status' => 3,
                    'tgl_periksa_sampel' => date('Y-m-d'),
                    'jam_periksa_sampel' => date('H:i:s'),
                    'periksa_sampel_oleh' => auth()->user()->id,
                    'hasil_pemeriksaan' => $request->hasil_pemeriksaan,
                    'hasil_golongan_sampel' => $request->hasil_golongan_sampel,
                    'hasil_rhesus_sampel' => $request->hasil_rhesus_sampel
                ],
            ];

            $type = $request->type;

            $data = Receipt::where('id', $id)
                ->update($processStatus[$type]);

            $orderStatusArr = [
                'ambil_sampel' => 3,
                'terima_sampel' => 3,
                'periksa_sampel' => 4,
            ];

            $order->status = $orderStatusArr[$type];
            $order->save();

            return $this->successApiResponse($data);

        } catch (\Exception $e) {
            return $this->errorApiResponse(500, $e->getMessage());
        }
    }
}