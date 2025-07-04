<?php
namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends BaseController {

    public function index(Request $request) {
        $page = $request->page ?? 10;

        $user = User::query()
            ->when(!empty($request->name), function($q) use ($request) {
                return $q->where('name', 'like', '%'.$request->name.'%');
            })
            ->when(!empty($request->nik), function($q) use ($request) {
                return $q->where('nik', 'like', '%'.$request->nik.'%');
            })
            ->when(!empty($request->email), function($q) use ($request) {
                return $q->where('email', 'like', '%'.$request->email.'%');
            })
            ->paginate($page);

        return view('admin.users.index', ['data' => $user ]);
    }

    public function create(Request $request) {
        return view('admin.users.create');
    }

    public function crateData(Request $request) {
        
    }

    public function detail(int $id, Request $request) {

    }

    public function updateData(int $id, Request $request) {

    }

    public function profile(Request $request) {
        $user = Auth::user();

        return view('users.profile', [
            'title' => 'Edit Profile',
            'data' => [
                'user' => $user,
            ]
        ]);
    }

    public function profileAction(Request $request) {
        $user = Auth::user();

        if (!$user) {
            return $this->redirectBack([
                'is_input' => true, 
                'is_error' => true, 
                'data' => 'User is not found'
            ]);
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        return $this->redirectBack([
            'is_success' => true, 
            'data' => 'User is updated successfully'
        ]);
    }

    public function changePassword(Request $request) {

    }
}