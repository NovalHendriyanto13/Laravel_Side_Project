<?php
namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Hospital;

class HospitalController extends ApiBaseController {
    public function index(Request $request) {
        $datas = Hospital::query()
            ->select([
                'id',
                'kode_rs',
                'nama_rs',
                'email',
                'no_telp',
                'penanggung_jawab_rs'
            ])
            ->get();

        return $this->successApiResponse($datas);
    }

    public function detail(int $id, Request $request) {
        try {
            $data = Hospital::find($id);

            if (!($data)) {
                return new \Exception('No data found');
            }

            return $this->successApiResponse($data);
        } catch (\Exception $e) {
            return $this->errorApiResponse(500, $e->getMessage()); 
        }
    }
    
}