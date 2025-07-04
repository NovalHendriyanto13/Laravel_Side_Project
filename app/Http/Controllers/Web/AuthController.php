<?php
namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthController extends BaseController {
    
    public function index(Request $request) {
        return view('admin.auth.login', [
            'title' => 'Login'
        ]);
    }

    public function forgot(Request $request) {
        return view('admin.auth.forgot', [
            'title' => 'Forgot Password'
        ]);
    }

    public function register(Request $request) {
        return view('auth.register', [
            'title' => 'Register User'
        ]);
    }

    public function login(Request $request) {
        $credentials = $request->only('email', 'password');

        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        try {
            if (!$token = Auth::attempt($credentials)) {
                return $this->redirectBack([
                    'is_error' => true,
                    'is_input' => true,
                    'data' => ['error' => 'Invalid credentials']
                ]);
            }
        } catch (JWTException $e) {
            return $this->redirectBack([
                'is_error' => true,
                'is_input' => true,
                'data' => ['error' => 'Could not create token']
            ]);
        }

        $request->session()->regenerate();
 
        return $this->redirectRoute('home', ['token' => $token]);
    }

    public function logout(Request $request) {
        Auth::logout();

        $request->session()->invalidate();      // Invalidate the session
        $request->session()->regenerateToken(); // Prevent CSRF issues on next login

        return $this->redirectRoute('auth.login'); 
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