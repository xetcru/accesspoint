<?php

namespace App\Http\Middleware;

use Closure; // Импортируем Closure, который используется в параметрах метода
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class Authenticate
{
    public function handle($request, Closure $next, ...$guards)
    {
        try {
            JWTAuth::parseToken()->authenticate();
        } catch (JWTException $e) {
            return response()->json(['error' => 'Token is invalid'], 401);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $next($request);
    }
}
