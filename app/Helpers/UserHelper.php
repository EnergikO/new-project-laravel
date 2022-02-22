<?php
namespace App\Helpers;

use App\Models\User;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Response;


class UserHelper {
    public static function getUsers($returnedFields = [])
    {
        $users = User::get($returnedFields);

        if (!empty($users)) {

            foreach($users as $user) {
                $user->posts;
            }
    
            return Response::json([
                'status' => 'ok',
                'users' => $users,
            ], 200);

        } else {
            return Response::json([
                'status' => 'error',
                'message' => 'No Users found',
            ], 404);
        }
    }

    public static function getUserById($id, $returnedFields = []) {
        $user = User::find($id, $returnedFields);

        if (!empty($user)) {
            $user->posts;
    
            return Response::json([
                'status' => 'ok',
                'users' => $user,
            ], 200);

        } else {
            return Response::json([
                'status' => 'error',
                'message' => 'User not found',
            ], 404);
        }

    }
}