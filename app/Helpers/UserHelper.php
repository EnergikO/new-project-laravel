<?php
namespace App\Helpers;

use App\Models\User;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Response;


class UserHelper {
    public static function getUsers($returnedFields = []) {
        $users = User::get($returnedFields);

        if (!empty($users)) {    
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

    public static function getUsersWithPosts($returnedFields = []) {
        $users = User::get($returnedFields);

        foreach ($users as $user) {
            $user->posts;
        }

        if (!empty($user)) {    

            return Response::json([
                'status' => 'ok',
                'users' => $users,
            ], 200);

        } else {

            return Response::json([
                'status' => 'error',
                'message' => 'Users not found',
            ], 404);
        }

    }

    public static function update($id, $inputData) {
        $user = User::find($id);

        if (empty($user)) {
            return Response::json([
                'status' => 'error',
                'message' => 'User not found',
            ], 404);
        }

        if ($user->update($inputData)) {
            return Response::json([
                'status' => 'success',
                'data' => [
                    'user' => $user,
                ],
            ], 200);

        } else {
            return Response::json([
                'status' => 'error',
                'message' => 'Something went wrong',
            ], 500);
        }
    }
    
    public static function detele($id) {
        $user = User::find($id);
        
        if (empty($user)) {
            return Response::json([
                'status' => 'error',
                'message' => 'User not found',
            ], 404);
        }

        $post = PostHelper::getPostsByAuthorId($user->id, 'message');

        if (empty($post)) {  
            User::destroy($id);

            return Response::json([
                'status' => 'success',
                'data' => null,
            ], 200);
        } else {
            return Response::json([
                'status' => 'error',
                'message' => 'Can\'t delete user with posts',
            ], 500);
        }
    }
}