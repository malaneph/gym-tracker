<?php

namespace App\Http\Controllers;

use App\Actions\CreateUserAction;
use App\Http\Requests\AuthUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;

class UserController extends Controller
{
    public function authUser(AuthUserRequest $request, CreateUserAction $action): UserResource|null
    {
        $user_data = $request->validated();
        if (!$user = User::where('telegram_id', $user_data['telegram_id'])->first()) {
            $action($user_data);

            return $user;
        }

        return UserResource::make($user);
    }
}
