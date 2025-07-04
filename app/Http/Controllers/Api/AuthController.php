<?php
namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\User;
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

            return $this->redirectBack([
                'is_success' => true,
                'data' => ['success' => 'User data is created successfully']
            ]);

        } catch (JWTException $e) {
            return $this->redirectBack([
                'is_error' => true,
                'is_input' => true,
                'data' => $e->getMessage()
            ]);
        }
    }
}