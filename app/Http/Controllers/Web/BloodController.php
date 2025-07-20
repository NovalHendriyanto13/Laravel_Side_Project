<?php
namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;

class BloodController extends BaseController {
    public function index(Request $request) {
        return view('admin.blood.index', [
            'title' => 'Master Data Darah'
        ]);
    }

    public function create(Request $request) {
        return view('admin.blood.create', [
            'title' => 'Tambah Data Darah'
        ]);
    }
};