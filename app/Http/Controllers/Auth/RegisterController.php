<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $user = new User([
             'name' => $request->name,
             'email' => $request->email,
             'password' => bcrypt($request->password)
        ]);

        $user->save();

        return response()->json([
             'message' => 'Successfully created user!'
        ], 201);
    }
}
