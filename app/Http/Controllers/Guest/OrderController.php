<?php 
namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class OrderController extends Controller {
    public function index(Request $request) {
        return view('guest.order.index');
    }

    public function create(Request $request) {
        return view('guest.order.create');
    }

    public function createNonBdrs(Request $request) {
        return view('guest.order.create_non_bdrs');
    }

    public function detail(int $id, Request $request) {
        return view('guest.order.update', [
            'id' => $id,
        ]);
    }
}