<?php

namespace App\Services;

use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthService
{
    public function createApiToken($user)
    {
        // Generate an API token for the user
        return $user->createToken('API Token')->plainTextToken;
    }
    public function login(array $credentials)
    {

        $validated = Validator::make([
            'Email' => $credentials['Email'],
            'password' => $credentials['password']
        ], [
            'Email' => ['required', 'email'],
            'password' => ['required'],
        ])->validate();
        try {
            // Attempt to authenticate the user
            if (!Auth::attempt($validated)) {
                throw new Exception("Invalid credentials");
            }
            // Get the authenticated user
            $authenticatedUser = Auth::user();
            $token = $this->createApiToken($authenticatedUser);
            // Check if the user account is active
            if ($authenticatedUser->Status == 0) {
                throw new Exception("Account is not active");
            }

            // Check if the users LoginFlag
            if ($authenticatedUser->LoginFlag == 0) {
                throw new Exception("Unauthorized user", 401);
            }

            // Authentication successful
            return [
                "user" => $authenticatedUser,
                "token" => $token
            ];
        } catch (Exception $e) {
            throw $e;
        }
    }
}
