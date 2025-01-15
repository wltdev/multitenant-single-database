<?php

namespace App\Services\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthenticateUserService
{
    /**
     * @param array $payload
     * @return bool
     */
    public function execute(string $email, string $password): ?object
    {
        $user = User::where('email', $email)->first();

        if (!$user || !Hash::check($password, $user->password)) {
            throw new \Exception('Credenciais inválidas');
        }

        // Create token with tenant information
        $token = $user->createToken('auth_token', ['tenant_id' => $user->tenant_id])->plainTextToken;

        return [
            'user' => $user,
            'token' => $token,
            'token_type' => 'Bearer'
        ];
    }
}
