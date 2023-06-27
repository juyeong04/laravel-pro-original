<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsernameController extends Controller
{
    public function findUsername(Request $request)
    {
        $email = $request->input('email');

        $user = User::where('email', $email)->first();

        if ($user) {
            $request->session()->put('u_id', $user->id);
            return view('welcome', ['username' => $user->username, 'u_id' => $user->id]);
        } else {
            $request->session()->forget('u_id');
            return view('auth.login');
        }
    }

}
