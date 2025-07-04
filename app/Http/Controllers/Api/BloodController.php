<?php
namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Blood;

class BloodController extends ApiBaseController {
    public function index(Request $request) {
        $datas = Blood::select([
            'id', 'code', 'name', 'blood_type', 'blood_type_alias'
        ])
            ->get();

        return $this->successApiResponse($datas);
    }

    public function getDropdown(Request $request) {
        $datas = Blood::select([
            'id', 'code', 'name', 'blood_type', 'blood_type_alias'
        ])
            ->orderBy('blood_type')
            ->get();

        $dropdowns = [];
        foreach($datas as $data) {
            $dropdowns[$data->id] = $data->name . ' - ' . $data->blood_type;
        }

        return $this->successApiResponse($dropdowns);
    }
}