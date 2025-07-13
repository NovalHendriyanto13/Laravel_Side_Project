<?php
namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends ApiBaseController {
    public function index() {
        $user = auth()->user();
        $hospital = $user->hospital ?? null;

        dd($hospital);
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
                'tgl_pemesanan' => date('Y-m-d', strtotime($request->tgl_pemesanan)),
                'tgl_diperlukan' => date('Y-m-d', strtotime($request->tgl_diperlukan)),
                'diagnosis' => $request->diagnosis,
                'alasan_transfusi' => $request->alasan_transfusi,
                'hb' => $request->hb,
                'trombosit' => $request->trombosit,
                'berat_badan' => $request->berat_badan,
                'nama_pasien' => $request->nama_pasien,
                'jenis_kelamin' => $request->jenis_kelamin,
                'nama_pasangan' => $request->nama_pasangan,
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => date('Y-m-d', strtotime($request->tanggal_lahir)),
                'alamat' => $request->alamat,
                'no_telp' => $request->no_telp,
                'transfusi_sebelumnya' => $request->transfusi_sebelumnya,
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

            if (!$data) {
                throw new \Exception('Add New Order is failed');
            }

            return $this->successApiResponse($data);

        } catch (\Exception $e) {
            return $this->errorApiResponse(500, $e->getMessage());
        }
    }
}