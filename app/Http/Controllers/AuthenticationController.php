<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class AuthenticationController extends Controller
{
    public function register(Request $request)
    {
        $user = User::create([
            'email' => $request->input('email'),
            'name' => $request->input('name'),
            'password' => $request->input('password'),
            //'password' => bcrypt($request->input('password')),
            'api_token' => Str::random(60),
        ]);

        return response()->json($user);
    }
}