<?php
namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Models\Blood;

class BloodStockController extends BaseController {
    public function index(Request $request) {
        return view('admin.blood_stock.index', [
            'title' => 'Stock Darah'
        ]);
    }

    public function create(Request $request) {
        $bloods = Blood::query()
            ->select([
                'id', 'name', 'blood_type', 'blood_type_alias'
            ])
            ->orderBy('blood_type')
            ->get();

        $dropdownBloods = [];
        foreach($bloods as $data) {
            $dropdownBloods[$data->id] = $data->name . ' - ' . $data->blood_type;
        }
        return view('admin.blood_stock.create', [
            'title' => 'Tambah Stock Darah',
            'bloods' => $dropdownBloods,
        ]);
    }
};