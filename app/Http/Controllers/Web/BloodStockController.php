<?php
namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;

class BloodStockController extends BaseController {
    public function index(Request $request) {
        return view('admin.blood_stock.index', [
            'title' => 'Stock Darah'
        ]);
    }

    public function create(Request $request) {
        return view('admin.blood_stock.create', [
            'title' => 'Tambah Stock Darah'
        ]);
    }
};