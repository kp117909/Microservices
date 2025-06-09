<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Http;
use App\Models\ExternalUser;

class CheckSession
{
    public function handle(Request $request, Closure $next)
    {
        $sessionId = $request->query('session_id');

        if (!$sessionId) {
             return redirect()->route('page.welcome');
        }

        $userId = Redis::get('session:' . $sessionId);

        if (!$userId) {
             return redirect()->route('page.welcome');
        }

        $response = Http::get("http://users/api/users/{$userId}");

        if (!$response->ok()) {
             return redirect()->route('page.welcome');
        }

        $userData = $response->json();
        if ( $userData['is_admin'] === false) {
            return redirect()->route('page.dashboard');
        }

        $userId = Redis::get('session:' . $sessionId);
        Redis::setex('session:' . $request->session()->getId(), 3600, $userId);

        $user = new ExternalUser($userData);
        
        $request->attributes->set('external_user', $user);
        $request->attributes->set('session_id', $sessionId);

        return $next($request);
    }
}
