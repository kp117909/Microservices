<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{

   public function authUserFromSession(Request $request)
    {
        $session_id = $request->query('session_id'); 

        if (!$session_id) {
            return view('welcome');
        }

        $user_id = Redis::get('session:' . $session_id);

        if (!$user_id) {
            return view('welcome');
        }

        $user = User::find($user_id);

        if (!$user) {
            return view('welcome');
        }

        Auth::loginUsingId($user_id);

        Redis::setex('session:' . Session::getId(), 3600, $user_id);

        return view('welcome');
    }

    public function redirectUsers()
    {
        $session_id = Session::getId();

        return redirect(env('USERS_SERVICE_URL') .'/auth/session?session_id=' . $session_id);
    }

}