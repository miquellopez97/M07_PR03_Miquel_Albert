<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request['password'] = bcrypt('password');
        $user = User::create($request->all());

        return response()->json([
            "User" => $user,
            "token" => $user->createToken('API Token')->plainTextToken,
            201]);
    }

    public function login()
    {
        $credentials = request(['email', 'password']);

        if (!Auth::attempt($credentials)) {
            return $this->error('Credentials not match', 401);
        }

        return response()->json([
            'User' => $credentials['email'],
            'token' => auth()->user()->createToken('API Token')->plainTextToken
        ]);
    }
}
