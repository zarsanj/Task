<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserCollection;
use App\Http\Resources\UserProfileResource;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index(): UserProfileResource
    {
        return new UserProfileResource(User::find(Auth::id()));
    }

    public function all(): UserCollection
    {
        return new UserCollection(User::all());
    }

    public function logout(): JsonResponse
    {
        auth()->logout();
        return response()->json(['message' => __('auth.logout')]);
    }
}
