<?php
namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Hospital;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthController extends ApiBaseController {
    
    public function login(Request $request) {
        $credentials = $request->only('email', 'password');

        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return $this->errorApiResponse(401, 'Invalid credentials');
            }
        } catch (JWTException $e) {
            return $this->errorApiResponse(401, 'Could not create token');
        }
 
        return $this->successApiResponse(['token' => $token, 'user' => Auth::user()]);
    }

    public function loginGuest(Request $request) {
        $credentials = $request->only('email', 'password');

        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return $this->errorApiResponse(401, 'Invalid credentials');
            }

            $user = Auth::user();
            if ($user->role != 'guest') {
                throw new \Exception('User is not allowed');
            }
        } catch (JWTException $e) {
            return $this->errorApiResponse(401, 'Could not create token');
        } catch (\Exception $e) {
            return $this->errorApiResponse(401, $e->getMessage());
        }
 
        return $this->successApiResponse(['token' => $token, 'user' => Auth::user()]);
    }

    public function logout(Request $request) {
        try {
            JWTAuth::invalidate(JWTAuth::getToken());
        } catch (JWTException $e) {
            return $this->errorApiResponse(500, 'Failed to logout, please try again');
        }

        return $this->successApiResponse($data = null, 'Successfully logged out');
    }

    public function registerAction(Request $request)
    {
        $request->validate([
            'nama_rs' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
        ]);

        try {
            $check = Hospital::query()
                ->select('id')
                ->where('email', $request->email)
                ->first();

            if ($check) {
                throw new \Exception('You have been registered, please login');
            }

            $hospitalCode = 'HOS'.date('YmdHis');
            $hospital = Hospital::create([  
                'kode_rs' => $hospitalCode,
                'nama_rs' => $request->nama_rs,
                'email' => $request->email,
                'no_telp' => $request->no_telp,
                'penanggung_jawab_rs' => $request->penanggung_jawab_rs,
                'kota' => $request->kota,
                'kode_pos' => $request->kode_pos,
                'alamat' => $request->alamat,
                'status' => 1,
            ]);

            if (!$hospital) {
                return new \Exception('Add data hospital is failed');
            }

            $user = User::create([
                'nik' => $hospitalCode,
                'name' => $request->nama_rs,
                'email' => $request->email,
                'username' => $request->email,
                'role' => 'guest',
                'password' => Hash::make($request->password),
            ]);

            return $this->successApiResponse(['data' => $user]);

        } catch (Exception $e) {
            return $this->errorApiResponse(500, $e->getMessage());
        }
    }
}