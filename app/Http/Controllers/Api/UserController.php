<?php
namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class UserController extends ApiBaseController {

    public function index(Request $request) {

        $user = User::query()
            ->select('*')
            ->get();

        return $this->successApiResponse($user);
    }

    public function create(Request $request) {
        $request->validate([
            'nik' => 'required|string|max:20|unique:users,nik',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        try {
            $user = User::create([
                'nik' => $request->nik,
                'name' => $request->name,
                'email' => $request->email,
                'username' => $request->email,
                'role' => $request->role ?? 'superadmin',
                'password' => Hash::make($request->password),
            ]);

            $token = JWTAuth::fromUser($user);

            return $this->successApiResponse(['token' => $token, 'user' => $user]);

        } catch (\Exception $e) {
            return $this->errorApiResponse(500, $e->getMessage());
        } catch (JWTException $e) {
            return $this->errorApiResponse(500, $e->getMessage());
        }
    }

    public function detail(int $id, Request $request) {
        try {
            $data = User::find($id);

            if (!($data)) {
                return new \Exception('No data found');
            }

            return $this->successApiResponse($data);
        } catch (\Exception $e) {
            return $this->errorApiResponse(500, $e->getMessage()); 
        }
    }

    public function update(int $id, Request $request) {
        $request->validate([
            'email' => 'required',
            'name' => 'required',
            'role' => 'required',
        ]);

        try {
            $data = User::find($id);

            if (!$data) {
                throw new \Exception('Data is not found');
            }

            $data->email = $request->email;
            $data->name = $request->name;
            $data->role = $request->role;
            $data->save();

            if (!$data) {
                throw new \Exception('Update Blood Stock is failed');
            }

            return $this->successApiResponse($data);

        } catch (\Exception $e) {
            return $this->errorApiResponse(500, $e->getMessage());
        }
    }

    public function profile(Request $request) {
        $request->validate([
            'email' => 'required',
            'name' => 'required',
        ]);

        try {
            $id = auth()->user()->id;
            $data = User::find($id);

            if (!$data) {
                throw new \Exception('Data is not found');
            }

            $data->email = $request->email;
            $data->name = $request->name;
            $data->save();

            if (!$data) {
                throw new \Exception('Update Blood Stock is failed');
            }

            return $this->successApiResponse($data);

        } catch (\Exception $e) {
            return $this->errorApiResponse(500, $e->getMessage());
        }
    }

    public function changePassword(Request $request) {
        try {
            $user = auth()->user();

            if (!Hash::check($request->old_password, $user->password)) {
                throw new \Exception('The old password is incorrect');
            }

            $user->password = Hash::make($request->password);
            $user->save();

            return $this->successApiResponse($user);

        } catch (\Exception $e) {
            return $this->errorApiResponse(500, $e->getMessage());
        }
        

        dd($user);
    }
}