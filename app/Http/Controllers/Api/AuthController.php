<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth;
use Validator;


class AuthController extends Controller
{
    public static function signup(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_name' => 'required|string|min:4|max:64',
            'login' => 'required|string|min:4|max:64|unique:users',
            'password' => 'required|string|min:4|max:100',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'fail',
                'data' => $validator->errors(),
            ], 400);
        }

        $user = User::create([
            'user_name' => $request->user_name,
            'login' => $request->login,
            'password' => Hash::make($request->password),
        ]);

        $_token = $user->createToken('_token')->plainTextToken;
        $user->_token = $_token;
        $user->save();

        return response()->json([
            'status' => 'success',
            'data' => [
                'user' => $user,
                'access_token' => $_token,
                'token_type' => 'Bearer',
            ],
        ], 201);
    }

    public static function login(Request $request)
    {

    }

    public static function logout(Request $request)
    {

    }

}
