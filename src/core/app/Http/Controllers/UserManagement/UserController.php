<?php

namespace App\Http\Controllers\UserManagement;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\AktivController;
use Illuminate\Support\Facades\Config;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Facades\JWTFactory;
use Tymon\JWTAuth\Providers\JWTAuthServiceProvider;
use Validator;

class UserController extends RobotController
{
    public function login(Request $request) {
        $credentials = $request->only('email', 'password');

        try {
            // verify the credentials and create a token for the user
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 401);
            }
        } catch (JWTException $e) {
            // something went wrong
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        // if no errors are encountered we can return a JWT
        return response()->json(compact('token'));

        return response()->json([
            'success' => 1,
            'response' => 'Aktiv API v0.1',
            compact('token')
        ]);
    }

    public function logout() {
        return response()->json([
            'success' => 1,
            'response' => 'Robot API v1.0'
        ]);
    }
}
