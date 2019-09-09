<?php

namespace App\Http\Controllers\Api\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Api\ApiMessages;
use Illuminate\Support\Facades\Validator;


class LoginController extends Controller
{


    public function login(Request $request)
    {
        $credentials = $request->all(['email', 'password']);

        Validator::make(
            $credentials,
            [
                'email' => 'required|string',
                'password' => 'required|string',
            ]
        )->validate();
        if (!$token = auth('api')->attempt($credentials)) {
            $message = new ApiMessages('unauthorized');
            return response()->json($message->getMessage(), 401);
        }
        return response()->json([
            'token' => $token
        ], 200);
    }


    public function logout()
    {
        auth('api')->logout();


        return response()->json([
            'message' => 'Logout suceffuly'
        ], 200);
    }

    public function refresh()
    {
        $token = auth('api')->refresh();


        return response()->json([
            'refresh' => $token
        ], 200);
    }
}
