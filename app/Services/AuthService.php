<?php

namespace App\Services;

use App\Repositories\RoleRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthService
{
    public function __construct(
        private UserRepository $userRepository,
        private RoleRepository $roleRepository
    ) {
    }

    public function register(array $payload): JsonResponse
    {
        $validator = Validator::make($payload, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $roleId = $this->roleRepository->getOrCreateDefaultRoleId();

        $user = $this->userRepository->create([
            'name' => $payload['name'],
            'email' => $payload['email'],
            'password' => Hash::make($payload['password']),
            'role_id' => $roleId,
        ]);

        return response()->json([
            'message' => 'Registration successful',
            'user' => $user,
        ], 201);
    }

    public function login(array $payload): JsonResponse
    {
        $validator = Validator::make($payload, [
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        if (!Auth::attempt(['email' => $payload['email'], 'password' => $payload['password']])) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        $user = Auth::user();
        $token = $user->createToken('cloudbox')->plainTextToken;

        return response()->json([
            'message' => 'Login successful',
            'token' => $token,
            'user' => $user,
        ]);
    }

    public function logout($user): JsonResponse
    {
        if ($user) {
            $user->currentAccessToken()?->delete();
        }

        return response()->json(['message' => 'Logged out']);
    }

    public function verifyEmail($user, array $payload): JsonResponse
    {
        return response()->json(['message' => 'verify-email']);
    }

    public function forgotPassword(array $payload): JsonResponse
    {
        return response()->json(['message' => 'forgot-password']);
    }

    public function resetPassword(array $payload): JsonResponse
    {
        return response()->json(['message' => 'reset-password']);
    }

    public function me($user): JsonResponse
    {
        return response()->json(['user' => $user]);
    }
}
