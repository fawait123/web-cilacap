<?php

namespace App\Http\Services;

use App\Http\Resources\UserCollection;
use App\Models\User;

class TeamService
{

    public function data()
    {
        $user =  User::latest()->get();

        return  new UserCollection($user);
    }
}
