<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Helpers\UserHelper;
use Validator;

class UserController extends Controller
{
    public function getUsers() {
        $returnedFields = [
            'id',
            'user_name',
            'login',
            'password',
        ];
        return UserHelper::getUsers($returnedFields);
    }

    public function getUserById($id) {
        $returnedFields = [
            'id',
            'user_name',
            'login',
        ];
        return UserHelper::getUserById($id, $returnedFields);
    }

    public function getUsersWithPosts() {
        $returnedFields = [
            'id',
            'user_name',
            'login',
        ];
        return UserHelper::getUsersWithPosts($returnedFields);
    }

    public function update(Request $request) {
        $request->merge(['id' => $request->id]);

        $validator = Validator::make($request->all(), [
            'user_name' => 'required|string|min:4|max:64',
            'login' => 'required|string|min:4|max:64|unique:users',
            'password' => 'required|string|min:4|max:100',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'fail',
                'data' => $validator->errors(),
            ], 400);
        }

        $inputData = $validator->validated();

        return UserHelper::update($request->id, $inputData);
    }
    
    public function delete($id) {
        return UserHelper::detele($id);
    }
}
