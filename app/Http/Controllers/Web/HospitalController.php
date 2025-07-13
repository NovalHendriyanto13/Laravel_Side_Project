<?php
namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Models\Hospital;

class HospitalController extends BaseController {
    public function index(Request $request) {
        return view('admin.hospital.index', [
            'title' => 'Rumah Sakit'
        ]);
    }

    public function detail(int $id, Request $request) {
        
        return view('admin.hospital.update', [
            'title' => 'Detail Rumah Sakit',
            'id' => $id,
        ]);
    }
};