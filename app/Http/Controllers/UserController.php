<?php

namespace App\Http\Controllers;

use App\Actions\CreateUserAction;
use App\Actions\UpdateUserSettingsAction;
use App\Http\Requests\AuthUserRequest;
use App\Http\Requests\UserSettingsRequest;
use App\Http\Resources\UserResource;
use App\Models\User;

class UserController extends Controller
{
    public function authUser(AuthUserRequest $request, CreateUserAction $action): UserResource|null
    {
        $user_data = $request->validated();
        if (!$user = User::where('telegram_id', $user_data['telegram_id'])->first()) {
            return UserResource::make($action($user_data));
        }

        return UserResource::make($user);
    }

    public function updateUserSettings(UserSettingsRequest $request, UpdateUserSettingsAction $action): UserResource
    {
        $data = $request->validated();

        return UserResource::make($action($data));
    }
}
