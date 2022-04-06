<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
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
        // bcrypt() //TODO: Bcrypt;
        $request['password'] = bcrypt('password');
        $user = User::create($request->all());

        return response()->json($user, 201);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string'
        ]);

        $credentials = request(['email', 'password']);

        if (!Auth::attempt($credentials)) {
            return response()->json([
                'message' => 'User not found'
            ], 404);
        }

        $user = $request->user();
        $remember_token = $user->createToken('Personal Access Token');

        return response()->json([
            'access_token' => $remember_token->accessToken,
            'token_type' => 'Bearer'
        ]);
    }
}
