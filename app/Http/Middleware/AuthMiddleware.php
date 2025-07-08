<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Auth\AuthenticationException;
use Exception;
use Illuminate\Support\Facades\Auth;

class AuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$guards): Response
    {
        try {
            $user = $this->authenticate($request, $guards);
            if ($user->role != 'guest') {
                throw new \Exception('User is not valid');
            }
        } catch (AuthenticationException $e) {
            return redirect()->guest(route('auth.login'));
        } catch (Exception $e) {
            return redirect()->guest(route('auth.login'));
        }

        return $next($request);
    }

    protected function authenticate($request, array $guards)
    {
        if (empty($guards)) {
            $guards = [null];
        }

        foreach ($guards as $guard) {
            if ($user = JWTAuth::parseToken()->authenticate()) {
                return $user;
            }
        }

        throw new AuthenticationException('Unauthenticated.', $guards);
    }
}
