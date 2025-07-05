<?php 
namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndexController extends Controller {
    public function index(Request $request) {
        return view('guest.home.index');
    }

    public function about(Request $request) {
        return view('guest.home.about');
    }

    public function register(Request $register) {
        return view('guest.home.register');
    }
}