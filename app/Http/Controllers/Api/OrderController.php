<?php
namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Blood;
use App\Models\Receipt;

class OrderController extends ApiBaseController {
    public function index() {
        $user = auth()->user();
        $hospital = $user->hospital ?? null;

        $datas = Order::query()
            ->with('orderDetail')
            ->select([
                'pemesanan.id',
                'pemesanan.kode_pemesanan',
                'pemesanan.rs_id',
                'pemesanan.tipe',
                'pemesanan.dokter',
                'pemesanan.tgl_pemesanan',
                'pemesanan.tgl_diperlukan',
                'pemesanan.nama_pasien',
                'pemesanan.diagnosis',
                'pemesanan.jenis_kelamin',
                'pemesanan.tempat_lahir',
                'pemesanan.tanggal_lahir',
                'pemesanan.no_telp',
                'pemesanan.status',
                'rumah_sakit.nama_rs',
                'rumah_sakit.kode_rs'
            ])
            ->leftJoin('rumah_sakit', 'pemesanan.rs_id', 'rumah_sakit.id')
            ->when(!empty($hospital), function($q) use ($hospital) {
                return $q->where('pemesanan.rs_id', $hospital->id);
            })
            ->orderBy('pemesanan.id', 'DESC')
            ->get();

        $datas->map(function($item) {
            $item->status = Order::$_status[$item->status];
            return $item;
        });

        return $this->successApiResponse($datas);
    }

    public function create(Request $request) {
        try {
            $code = [
                'bdrs' => 'BD0',
                'non_bdrs' => 'NBD'
            ];
            
            $data = Order::create([
                'rs_id' => $request->rs_id,
                'kode_pemesanan' => $code[$request->tipe].(date('dmyhis')).'/'.date('Y'),
                'tipe' => $request->tipe,
                'dokter' => $request->dokter,
                'tgl_pemesanan' => date('Y-m-d'),
                'tgl_diperlukan' => date('Y-m-d', strtotime($request->tgl_diperlukan)),
                'diagnosis' => $request->diagnosis,
                'alasan_transfusi' => $request->alasan_transfusi,
                'hb' => $request->hb,
                'trombosit' => $request->trombosit,
                'berat_badan' => $request->berat_badan,
                'nama_pasien' => $request->nama_pasien,
                'status_nikah' => $request->status_nikah,
                'jenis_kelamin' => $request->jenis_kelamin,
                'nama_pasangan' => $request->nama_pasangan,
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => date('Y-m-d', strtotime($request->tanggal_lahir)),
                'alamat' => $request->alamat,
                'no_telp' => $request->no_telp,
                'transfusi_sebelumnya' => $request->transfusi_sebelumnya ?? 0,
                'tgl_transfusi_sebelumnya' => date('Y-m-d', strtotime($request->tgl_transfusi_sebelumnya)),
                'gejala_reaksi' => $request->gejala_reaksi,
                'tempat_serologi' => $request->tempat_serologi,
                'tgl_serologi' => $request->tgl_serologi,
                'hasil_serologi' => $request->hasil_serologi,
                'hamil' => $request->hamil ?? 0,
                'jumlah_kehamilan' => $request->jumlah_kehamilan,
                'pernah_aborsi' => $request->pernah_aborsi ?? 0,
                'status' => 1,
                'created_by' => auth()->user()->id,
            ]);

            $items = json_decode($request->items);
            $payloadItems = array_map(function($item) use($data) {
                $bloodGroup = [];
                if (!empty($item->golongan)) {
                    $bloodGroup = explode('_', $item->golongan);
                }
                return [
                    'blood_id' => $item->id,
                    'golongan' => $bloodGroup[0] ?? null,
                    'rhesus' => $bloodGroup[1] ?? null,
                    'jumlah_ml' => $item->jumlah_ml,
                    'jumlah' => $item->jumlah,
                    'status' => 0,
                    'pemesanan_id' => $data->id, 
                ];
            }, $items);

            $orderDetail = OrderDetail::insert($payloadItems);

            if (!$data) {
                throw new \Exception('Add New Order is failed');
            }

            return $this->successApiResponse($data);

        } catch (\Exception $e) {
            return $this->errorApiResponse(500, $e->getMessage());
        }
    }

    public function detail(int $id, Request $request) {
        try {
            $data = Order::with('orderDetail')
                ->where('id', $id)
                ->first();

            if (!($data)) {
                return new \Exception('No data found');
            }

            $data->status_id = $data->status;
            $data->status = Order::$_status[$data->status];

            return $this->successApiResponse($data);
        } catch (\Exception $e) {
            return $this->errorApiResponse(500, $e->getMessage()); 
        }
    }

    public function update($id, Request $request) {
        try {
            $code = [
                'bdrs' => 'BD0',
                'non_bdrs' => 'NBD'
            ];

            $data = Order::find($id);
            if (!$data || empty($data)) {
                throw new \Exception('Data is not found');
            }

            if ($data->status != 1) {
                throw new \Exception('Data tidak bisa di update, status sedang di process');
            }
            
            $data->tipe = $request->tipe;
            $data->dokter = $request->dokter;
            $data->tgl_diperlukan = date('Y-m-d', strtotime($request->tgl_diperlukan));
            $data->diagnosis = $request->diagnosis;
            $data->alasan_transfusi = $request->alasan_transfusi;
            $data->hb = $request->hb;
            $data->trombosit = $request->trombosit;
            $data->berat_badan = $request->berat_badan;
            $data->nama_pasien = $request->nama_pasien;
            $data->status_nikah = $request->status_nikah;
            $data->jenis_kelamin = $request->jenis_kelamin;
            $data->nama_pasangan = $request->nama_pasangan;
            $data->tempat_lahir = $request->tempat_lahir;
            $data->tanggal_lahir = date('Y-m-d', strtotime($request->tanggal_lahir));
            $data->alamat = $request->alamat;
            $data->no_telp = $request->no_telp;
            $data->transfusi_sebelumnya = $request->transfusi_sebelumnya ?? 0;
            $data->tgl_transfusi_sebelumnya = date('Y-m-d', strtotime($request->tgl_transfusi_sebelumnya));
            $data->gejala_reaksi = $request->gejala_reaksi;
            $data->tempat_serologi = $request->tempat_serologi;
            $data->tgl_serologi = $request->tgl_serologi;
            $data->hasil_serologi = $request->hasil_serologi;
            $data->hamil = $request->hamil ?? 0;
            $data->jumlah_kehamilan = $request->jumlah_kehamilan;
            $data->pernah_aborsi = $request->pernah_aborsi ?? 0;
            $data->status = 1;
            $data->updated_by = auth()->user()->id;
            $data->save();

            $items = json_decode($request->items);
            foreach($items as $item) {
                $bloodGroup = [];
                if (!empty($item->golongan)) {
                    $bloodGroup = explode('_', $item->golongan);
                }
                $orderDetails = !empty($item->pid) ?? null;
                if (!empty($orderDetails)) {
                    $orderDetail = OrderDetail::find($item->pid);
                    $orderDetail->blood_id = $item->id;
                    $orderDetail->jumlah = $item->jumlah;
                    $orderDetail->jumlah_ml = $item->jumlah_ml;
                    $orderDetail->golongan = $bloodGroup[0] ?? null;
                    $orderDetail->rhesus = $bloodGroup[1] ?? null;
                    $orderDetail->status = 0;
                    $orderDetail->pemesanan_id = $data->id;
                    $orderDetail->save(); 
                } else {
                    OrderDetail::create([
                        'blood_id' => $item->id,
                        'jumlah_ml' => $item->jumlah_ml,
                        'golongan' => $bloodGroup[0] ?? null,
                        'rhesus' => $bloodGroup[1] ?? null,
                        'jumlah' => $item->jumlah,
                        'status' => 0,
                        'pemesanan_id' => $data->id, 
                    ]);
                }
            }
            if (!$data) {
                throw new \Exception('Add New Order is failed');
            }

            return $this->successApiResponse($data);

        } catch (\Exception $e) {
            return $this->errorApiResponse(500, $e->getMessage());
        }
    }

    public function report(Request $request) {
        if (empty($request->order_start_date) || empty($request->order_end_date)) {
            return $this->errorApiResponse(500, 'Start date dan end date wajib diisi');
        }

        $items = Order::query()
            ->select([
                'pemesanan.id',
                'pemesanan.kode_pemesanan',
                'pemesanan.rs_id',
                'pemesanan.tipe',
                'pemesanan.dokter',
                'pemesanan.tgl_pemesanan',
                'pemesanan.tgl_diperlukan',
                'pemesanan.nama_pasien',
                'pemesanan.diagnosis',
                'pemesanan.jenis_kelamin',
                'pemesanan.tempat_lahir',
                'pemesanan.tanggal_lahir',
                'pemesanan.no_telp',
                'pemesanan.status',
                'rumah_sakit.nama_rs',
                'rumah_sakit.kode_rs'
            ])
            ->leftJoin('rumah_sakit', 'pemesanan.rs_id', 'rumah_sakit.id')
            ->when(!empty($request->order_start_date) || !empty($request->order_end_date),function($q)use($request){
                return $q->whereBetween('pemesanan.tgl_pemesanan',[[
                    date('Y-m-d 00:00:00', strtotime($request->order_start_date ?? '1970-01-01 00:00:00')),
                    date('Y-m-d 23:59:59', strtotime($request->order_end_date ?? '2200-01-01 23:59:59'))
                ]]);
            })
            ->orderBy('pemesanan.id', 'DESC')
            ->get();

        $items->map(function($item) {
            $item->status = Order::$_status[$item->status];
            $item->tipe = str_replace(['_'], ' ', strtoupper($item->tipe));
            return $item;
        });

        $dates = [
            'start_date' => date('d F Y', strtotime($request->order_start_date)),
            'end_date' => date('d F Y', strtotime($request->order_end_date))
        ];

        $pdf = Pdf::loadView('admin.pdf.order', compact('items', 'dates'));

        // // Download langsung
        return $pdf->download('laporan-penjualan.pdf');
    }

    public function preview(int $id, Request $request) {
        $user = auth()->user();
        $hospital = $user->hospital ?? null;

        $data = Order::query()
            ->with('orderDetail')
            ->select([
                'pemesanan.*',
                'rumah_sakit.nama_rs',
                'rumah_sakit.kode_rs',
                'rumah_sakit.alamat AS alamat_rs',
            ])
            ->leftJoin('rumah_sakit', 'pemesanan.rs_id', 'rumah_sakit.id')
            ->where('pemesanan.id', $id)
            ->orderBy('pemesanan.id', 'DESC')
            ->first();

        if (!empty($data)) {
            $data->status = Order::$_status[$data->status];
            $data->tgl_transfusi_sebelumnya = $data->tgl_transfusi_sebelumnya == '1970-01-01' ? '' : $data->tgl_transfusi_sebelumnya;
        };

        $bloods = Blood::query()
            ->select(['id', 'name', 'blood_type'])
            ->get();

        $bloodData = [];
        foreach($bloods as $blood) {
            $jumlahMl = 0;
            $jumlah = 0;
            $orderDetail = ($data->orderDetail)->toArray() ?? [];

            $isExists = array_search($blood->id, array_column($orderDetail, 'blood_id'));
            if ($isExists !== false) {
                $jumlahMl = $orderDetail[$isExists]['jumlah_ml'];
                $jumlah = $orderDetail[$isExists]['jumlah'];
            }
            $bloodData[$blood->blood_type][] = [
                'name' => $blood->name,
                'jumlah_ml' => $jumlahMl == 0 ? '' : $jumlahMl,
                'jumlah' => $jumlah == 0 ? '' : $jumlah,
            ];
        }

        $dataReceipt = Receipt::select([
            'penerimaan.*',
            'pengambil.name AS pengambil',
            'penerima.name AS penerima',
            'pemeriksa.name AS pemeriksa'
        ])
            ->with('receiptDetail')
            ->where('pemesanan_id', $id)
            ->leftJoin('users AS pengambil', 'pengambil.id', 'penerimaan.ambil_sampel_oleh')
            ->leftJoin('users AS penerima', 'penerima.id', 'penerimaan.terima_sampel_oleh')
            ->leftJoin('users AS pemeriksa', 'pemeriksa.id', 'penerimaan.periksa_sampel_oleh')
            ->first();
            
        $hasilPemeriksaan = [
            'Tidak Cocok', 'Cocok'
        ];
        
        return view('admin.pdf.preview', compact('data', 'bloodData', 'dataReceipt', 'hasilPemeriksaan'));
    }
}