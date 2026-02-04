<?php

namespace App\Services;

class AuthService
{
    public function register(array $payload)
    {
        return ['message' => 'register'];
    }

    public function login(array $payload)
    {
        return ['message' => 'login'];
    }

    public function logout($user)
    {
        return ['message' => 'logout'];
    }

    public function verifyEmail($user, array $payload)
    {
        return ['message' => 'verify-email'];
    }

    public function forgotPassword(array $payload)
    {
        return ['message' => 'forgot-password'];
    }

    public function resetPassword(array $payload)
    {
        return ['message' => 'reset-password'];
    }

    public function me($user)
    {
        return ['message' => 'me'];
    }
}
