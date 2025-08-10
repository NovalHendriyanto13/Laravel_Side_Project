<?php 
namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class BloodStockController extends Controller {
    public function index(Request $request) {
        return view('guest.blood-stock.index');
    }
}