<?php

namespace App\Http\Controllers;

use App\Actions\CreateUser;
use App\Actions\UpdateUserSettings;
use App\Http\Requests\AuthUserRequest;
use App\Http\Requests\UserSettingsRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Queries\GetUserQuery;

class UserController extends Controller
{
    public function authUser(AuthUserRequest $request, CreateUser $action): ?UserResource
    {
        $user_data = $request->validated();
        if (!$user = User::where('username', $user_data['username'])->first()) {
            $action($user_data);
            return UserResource::make(User::where('username', $user_data['username'])->first());
        }

        return UserResource::make($user);
    }

    public function updateUserSettings(UserSettingsRequest $request, UpdateUserSettings $action): UserResource
    {
        $data = $request->validated();

        return UserResource::make($action($data));
    }

    public function show(GetUserQuery $query): UserResource
    {
        $user = new $query;

        return UserResource::make($user);
    }
}
