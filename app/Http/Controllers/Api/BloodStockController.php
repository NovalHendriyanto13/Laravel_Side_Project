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
                'blood.name',
                'blood.blood_type'
            ])
            ->leftJoin('blood', 'blood_stock.blood_id', 'blood.id')
            ->orderBy('blood_stock.expiry_date', 'DESC')
            ->get();

        return $this->successApiResponse($datas);
    }

    public function create(Request $request) {

    }
}