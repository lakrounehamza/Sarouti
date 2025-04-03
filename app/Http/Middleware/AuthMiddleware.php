<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenBlacklistedException;

class AuthMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->is('api/login')) {
            return $next($request);
        }

        try {
            if (!$token = JWTAuth::parseToken()) {
                throw new JWTException('Token not provided');
            }

            $user = JWTAuth::authenticate($token);

            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'User not found or inactive'
                ], 404);
            }

        } catch (TokenInvalidException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid authentication token'
            ], 401);

        } catch (TokenExpiredException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Authentication token expired',
                'action' => 'refresh_token' 
            ], 401);

        } catch (TokenBlacklistedException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Authentication token revoked'
            ], 401);

        } catch (JWTException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Authentication token is required',
                'hint' => 'Include Authorization: Bearer {token} in headers'
            ], 401);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Authentication service unavailable'
            ], 500);
        }

        return $next($request);
    }
}