<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Helpers\UserHelper;

class UserController extends Controller
{

    public function getUsers()
    {        
        $returnedFields = [
            'id',
            'user_name',
            'login',
            'password',
        ];
        return UserHelper::getUsers($returnedFields);
    }

    public function getUserById($id)
    {        
        $returnedFields = [
            'id',
            'user_name',
            'login',
        ];
        return UserHelper::getUserById($id, $returnedFields);
    }

}
