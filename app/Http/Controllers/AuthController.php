<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\RegisterUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(RegisterUserRequest $request)
    {
        $data = $request->validated();

        $data['roles'] = ['guest', 'viewer'];

        $user = User::create($data);

        return $user;
    }

    public function login(LoginUserRequest $request)
    {

        $data = $request->validated();

        $exists = Auth::attempt($data);

        if ($exists) {
            $user = Auth::user();

            // Create a token using sanctum

            $token = $user->createToken('login', $user->roles)->plainTextToken;

            // $user_data = [
            //     'user' => $user,
            //     'token' => $token,
            // ];
            // return $user_data;

            $user['token'] = $token;

            return $user;
        } else {
            return 'Try again';
        }


    }
    public function logout()
    {
    }
    public function forgetPassword()
    {
    }
    public function resetPassword()
    {
    }
}
