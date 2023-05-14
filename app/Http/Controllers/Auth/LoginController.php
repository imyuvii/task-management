<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(LoginRequest $request): \Illuminate\Http\JsonResponse
    {
        if (!Auth::attempt($request->only('email', 'password'))) {
            throw new HttpResponseException(response()->json([
                'success'   => false,
                'message'   => __('auth.failed'),
            ]));
        }
        $user = $request->user();
        $token = $user->createToken('authToken')->plainTextToken;
        return response()->json([
            'success'   => true,
            'token'     => $token,
            'user'      => $user,
        ]);
    }
}
