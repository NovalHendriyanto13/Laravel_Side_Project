<?php
namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Blood;

class BloodController extends ApiBaseController {
    private $_prefix = [
        'Whole Blood' => 'WB',
        'Packed Red Cell' => 'PR',
        'WE' => 'WE',
        'TC' => 'TC',
        'Plasma' => 'PD'
    ];

    public function index(Request $request) {
        $datas = Blood::select([
            'id', 'code', 'name', 'blood_type', 'blood_type_alias'
        ])
            ->get();

        return $this->successApiResponse($datas);
    }

    public function create(Request $request) {
        $request->validate([
            'name' => 'required',
            'blood_type' => 'required',
        ]);

        try {
            $number = 1;
            $prefix = $this->_prefix[$request->blood_type_alias];
            $latestID = Blood::select('code')
                ->where('blood_type_alias', $request->blood_type_alias)
                ->orderBy('code', 'desc')
                ->first();

            if (!empty($latestID)) {
                $lastNumber = (int) substr($latestID->code, strlen($prefix));
                $number = $lastNumber + 1;
            }
            $code = $prefix.(str_pad($number, 4, '0', STR_PAD_LEFT));

            $data = Blood::create([
                'code' => $code,
                'name' => $request->name,
                'blood_type' => $request->blood_type,
                'blood_type_alias' => $request->blood_type_alias,
                'created_by' => auth()->user()->id,
            ]);

            if (!$data) {
                throw new \Exception('Add New Blood is failed');
            }

            return $this->successApiResponse($data);

        } catch (\Exception $e) {
            return $this->errorApiResponse(500, $e->getMessage());
        }
    }

    public function detail(int $id, Request $request) {
        try {
            $data = Blood::find($id);

            if (!($data)) {
                return new \Exception('No data found');
            }

            return $this->successApiResponse($data);
        } catch (\Exception $e) {
            return $this->errorApiResponse(500, $e->getMessage()); 
        }
    }
    public function update(int $id, Request $request) {
        $request->validate([
            'name' => 'required',
            'blood_type' => 'required',
        ]);

        try {
            $data = Blood::find($id);

            if (!$data) {
                throw new \Exception('Data is not found');
            }
            $data->name = $request->name;
            $data->updated_by = auth()->user()->id;
            $data->save();

            if (!$data) {
                throw new \Exception('Update Blood Stock is failed');
            }

            return $this->successApiResponse($data);

        } catch (\Exception $e) {
            return $this->errorApiResponse(500, $e->getMessage());
        }
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