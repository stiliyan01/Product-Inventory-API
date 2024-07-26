<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ApiLoginUserRequest;

class AuthController extends Controller {

    public function login(ApiLoginUserRequest $request)
    {
        $request->validated($request->all());
        
        if(!Auth::attempt($request->only('email', 'password'))){
            return $this->error('Invalid credentials', 401);
        }
        
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return $this->error('User not found', 404);
        }

        return $this->ok(
            'User logged in successfully', 
            [
                'token' => $user->createToken('auth_token', ['*'], now()->addMonth())->plainTextToken
            ]);
    }


    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return $this->ok('Token deleted successfully');
    }
}