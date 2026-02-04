<?php

namespace App\Http\Controllers;

use App\Services\AuthService;
use Illuminate\Http\Request;

class AuthController
{
    public function __construct(private AuthService $authService)
    {
    }

    public function register(Request $request)
    {
        return $this->authService->register($request->all());
    }

    public function login(Request $request)
    {
        return $this->authService->login($request->all());
    }

    public function logout(Request $request)
    {
        return $this->authService->logout($request->user());
    }

    public function verifyEmail(Request $request)
    {
        return $this->authService->verifyEmail($request->user(), $request->all());
    }

    public function forgotPassword(Request $request)
    {
        return $this->authService->forgotPassword($request->all());
    }

    public function resetPassword(Request $request)
    {
        return $this->authService->resetPassword($request->all());
    }

    public function me(Request $request)
    {
        return $this->authService->me($request->user());
    }
}
