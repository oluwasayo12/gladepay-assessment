<?php

namespace App\Services;

use App\Models\User;
use App\Traits\ApiResponse;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class AuthService
{
    use ApiResponse;

    public function credentials(array $input): array
    {
        $email = $input["email"];
        $password = $input["password"];

        return [
            'email' => $email,
            'password' => $password,
            'status' => true
        ];
    }

    public function login(array $input)
    {
        $credentials = $this->credentials($input);

        if(Auth::guard('client-api')->attempt($credentials)){ 
            $user = Auth::guard('client-api')->user();  
            $tokenResult = $user->createToken('Personal Access Token');
            $token = $tokenResult->plainTextToken;

            $payload =  [
                'token' => $token,
                'user' => $user,
            ];
            return $this->ok($payload);
        } 
        else{ 
            abort(401, 'Invalid credentials');
        } 
    }
}
