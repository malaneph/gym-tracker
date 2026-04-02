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
        $user_data = json_decode($request->validated('webAppData')['user'], true, flags: JSON_THROW_ON_ERROR);

        if (! $user = User::where('telegram_id', $user_data['id'])->first()) {
            $action($user_data);
            $user = User::where('telegram_id', $user_data['id'])->first();
        }

        return response()->json([
            'user' => UserResource::make($user),
            'token' => $user->createToken('auth_token')->plainTextToken,
        ]);
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
