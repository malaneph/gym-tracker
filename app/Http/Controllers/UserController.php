<?php

namespace App\Http\Controllers;

use App\Actions\CreateUser;
use App\Actions\UpdateUserSettings;
use App\Http\Requests\User\AuthRequest;
use App\Http\Requests\User\LoginRequest;
use App\Http\Requests\User\SettingsRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Queries\UserQuery;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    public function authUser(AuthRequest $request, CreateUser $action): UserResource|JsonResponse
    {
        $user_data = $request->validated();

        if (! $user = User::where('username', $user_data['username'])->first()) {
            $action($user_data);
            $user = User::where('username', $user_data['username'])->first();

            return response()->json([
                'user' => UserResource::make($user),
                'token' => $user->createToken('auth_token')->plainTextToken,
            ], 201);
        }

        return UserResource::make($user);
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->validated();
        if (! auth()->attempt($credentials)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }
        $user = auth()->user();
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json(['user' => UserResource::make($user), 'token' => $token]);
    }

    public function updateUserSettings(SettingsRequest $request, UpdateUserSettings $action): UserResource
    {
        $user = auth()->user();
        $action($user, $request->validated());

        return UserResource::make($user->refresh());
    }

    public function show(UserQuery $query): UserResource
    {
        return UserResource::make(auth()->user());
    }
}
