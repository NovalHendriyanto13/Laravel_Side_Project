<?php
namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;

class IndexController extends BaseController {
    public function index(Request $request) {
        return view('admin.home.index');
    }
}