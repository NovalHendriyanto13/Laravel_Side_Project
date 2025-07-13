<?php
namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Models\Blood;

class OrderController extends BaseController {
    public function index(Request $request) {
        return view('admin.order.index', [
            'title' => 'Pemesanan'
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

    public function detail(int $id, Request $request) {
        return view('admin.order.update', [
            'title' => 'Detail Stock Darah',
            'id' => $id,
        ]);
    }
};