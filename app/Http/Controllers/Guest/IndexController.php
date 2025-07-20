<?php 
namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class IndexController extends Controller {
    public function index(Request $request) {
        $user = null;
        if ($request->query('token')) {
            $user = JWTAuth::parseToken()->authenticate();
        }

        return view('guest.home.index', [ 'user' => $user]);
    }

    public function about(Request $request) {
        $user = null;
        if ($request->query('token')) {
            $user = JWTAuth::parseToken()->authenticate();
        }

        return view('guest.home.about', [ 'user' => $user ]);
    }

    public function register(Request $register) {
        return view('guest.home.register');
    }
}