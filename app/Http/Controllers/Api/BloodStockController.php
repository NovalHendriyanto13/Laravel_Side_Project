<?php
namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\BloodStock;

class BloodStockController extends ApiBaseController {
    public function index(Request $request) {
        $datas = BloodStock::query()
            ->select([
                'blood_stock.id',
                'blood_stock.stock_no',
                'blood_stock.expiry_date',
                'blood_stock.blood_group',
                'blood_stock.blood_rhesus',
                'blood_stock.unit_volume',
                'blood_stock.status',
                'blood.name',
                'blood.blood_type'
            ])
            ->leftJoin('blood', 'blood_stock.blood_id', 'blood.id')
            ->when(!empty($request->blood_id), function ($q) use ($request) {
                return $q->where('blood_stock.blood_id', $request->blood_id);
            })
            ->when(!empty($request->status) || $request->status == 0, function ($q) use ($request) {
                return $q->where('blood_stock.status', $request->status);
            })
            ->when(!empty($request->blood_group), function ($q) use ($request) {
                return $q->where('blood_stock.blood_group', $request->blood_group);
            })
            ->when(!empty($request->blood_rhesus), function ($q) use ($request) {
                return $q->where('blood_stock.blood_rhesus', $request->blood_rhesus);
            })
            ->orderBy('blood_stock.expiry_date', 'DESC')
            ->get();

        return $this->successApiResponse($datas);
    }

    public function ml(Request $request) {
        $bloodId = $request->blood_id;
        $datas = BloodStock::query()
            ->select([
                'unit_volume',
            ])
            ->where('blood_id', $bloodId)
            ->where('status', 1)
            ->groupBy('unit_volume')
            ->get();

        return $this->successApiResponse($datas);
    }

    public function create(Request $request) {
        $request->validate([
            'stock_no' => 'required|string|max:20|unique:blood_stock,stock_no',
            'expiry_date' => 'required',
            'blood_id' => 'required',
            'unit_volume' => 'required',
            'blood_group' => 'required',
            'blood_rhesus' => 'required',
        ]);

        try {
            $data = BloodStock::create([
                'stock_no' => $request->stock_no,
                'expiry_date' => date('Y-m-d', strtotime($request->expiry_date)),
                'blood_id' => $request->blood_id,
                'unit_volume' => $request->unit_volume,
                'blood_group' => $request->blood_group,
                'blood_rhesus' => $request->blood_rhesus,
                'status' => $request->status,
                'created_by' => auth()->user()->id,
            ]);

            if (!$data) {
                throw new \Exception('Add New Blood Stock is failed');
            }

            return $this->successApiResponse($data);

        } catch (\Exception $e) {
            return $this->errorApiResponse(500, $e->getMessage());
        }
    }

    public function detail(int $id, Request $request) {
        try {
            $data = BloodStock::find($id);

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
            'expiry_date' => 'required',
            'blood_id' => 'required',
            'unit_volume' => 'required',
            'blood_group' => 'required',
            'blood_rhesus' => 'required',
        ]);

        try {
            $data = BloodStock::find($id);

            if (!$data) {
                throw new \Exception('Data is not found');
            }

            $data->stock_no = $request->stock_no;
            $data->expiry_date = date('Y-m-d', strtotime($request->expiry_date));
            $data->blood_id = $request->blood_id;
            $data->unit_volume = $request->unit_volume;
            $data->blood_group = $request->blood_group;
            $data->blood_rhesus = $request->blood_rhesus;
            $data->status = $request->status;
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
}