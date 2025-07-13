<?php
namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends BaseController {

    public function index(Request $request) {
        return view('admin.users.index', [
            'title' => 'Users'
        ]);
    }

    public function create(Request $request) {
        return view('admin.users.create', [
            'title' => 'Tambah Users'
        ]);
    }

    public function detail(int $id, Request $request) {
        return view('admin.users.update', [
            'title' => 'Detail User',
            'id' => $id,
        ]);
    }

    public function profile(Request $request) {
        $user = Auth::user();

        return view('admin.users.profile', [
            'title' => 'Edit Profile',
            'data' => [
                'user' => $user,
            ],
            'id' => $user->id,
        ]);
    }

    public function changePassword(Request $request) {

    }
}