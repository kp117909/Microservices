<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Http;
use App\Models\ExternalUser;

class AuthFromSessionId
{
    public function handle(Request $request, Closure $next)
    {
        $sessionId = $request->query('session_id');
        $user = null;
        if ($sessionId) {
            $userId = Redis::get('session:' . $sessionId);
            if ($userId) {
                $response = Http::get("http://users/api/users/{$userId}");
                if ($response->ok()) {
                    $userData = $response->json();
                    $user = new ExternalUser($userData);
                    Redis::setex('session:' . $request->session()->getId(), 3600, $userId);
                }
            }
        }
        $request->attributes->set('external_user', $user);
        $request->attributes->set('session_id', $sessionId);

        return $next($request);
    }
}

