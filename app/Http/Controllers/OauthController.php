<?php

namespace App\Http\Controllers;

use App\Http\Requests\OauthRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class OauthController extends Controller
{
    public function login(OauthRequest $request)
    {
        $user = User::where('email', $request->email)->first();

        if (!$user) return response()->json([
            'message' => 'User not found',
            'error' => true,
            'code' => 404,
            'response' => null
        ]);

        if (!Hash::check($request->password, $user->password)) return response()->json([
            'message' => 'Incorrect password',
            'error' => true,
            'code' => 401,
            'response' => null
        ]);

        Auth::login($user);

        if (Auth::check()) {
            return redirect()->route('dashboard.index');
        } else {
            return redirect()->route('login');
        }
    }
}
