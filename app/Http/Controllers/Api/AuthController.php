<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    public function register(StoreUserRequest $request): JsonResponse
    {
        User::create([
            User::NAME => $request->validated('name'),
            User::EMAIL => @$request->validated('email'),
            User::MOBILE => $request->validated('mobile'),
            User::PASSWORD => $request->validated('password'),
        ]);

        return response()->json([
            'status' => true,
            'message' => __('auth.userCreated')
        ]);
    }

    public function login(): JsonResponse
    {
        $credentials = request(['mobile', 'password']);

        if (!$token = auth()->attempt($credentials))
            return response()->json(['error' => 'Unauthorized'], 401);

        return $this->respondWithToken($token);
    }

    protected function respondWithToken($token): JsonResponse
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }

    public function logout(): JsonResponse
    {
        auth()->logout();
        return response()->json(['message' => __('auth.logout')]);
    }
}
