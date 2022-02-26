<?php
namespace App\Helpers;

use App\Models\User;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Response;

class PostHelper {
    public static function getPosts($returnedFields=[]) {
        $posts = Post::get($returnedFields);

        if (!empty($posts)) {
            return Response::json([
                'status' => 'ok',
                'posts' => $posts,
            ], 200);

        } else {
            return Response::json([
                'status' => 'error',
                'message' => 'No post found',
            ], 404);
        }
    }

    public static function getPostById($id, $returnedFields=[]) {
        $post = Post::find($id, $returnedFields);

        if (!empty($post)) {
            return Response::json([
                'status' => 'ok',
                'post' => $post,
            ], 200);

        } else {
            return Response::json([
                'status' => 'error',
                'message' => 'Post not found',
            ], 404);
        }
    }

    public static function getPostsByAuthorId($author_id, $returnedFields=[]) {
        $posts = Post::where('author_id', $author_id)->get($returnedFields);

        if (!$posts->isEmpty()) {    
            return Response::json([
                'status' => 'ok',
                'posts' => $posts,
            ], 200);
    
        } else {
            return Response::json([
                'status' => 'error',
                'message' => 'For this user not found any posts',
            ], 404);
        }
    }
    
    public static function add($inputData) {
        $user = auth()->user();

        $inputData['author_id'] = $user->id;

        $post = Post::create($inputData);

        if ($post->save()) {
            return Response::json([
                'status' => 'success',
                'data' => [
                    'post' => $post,
                ],
            ], 201);
        } else {
            return Response::json([
                'status' => 'error',
                'message' => 'Something went wrong',
            ], 500);
        }
    }
    
    public static function update($id, $inputData) {
        $post = Post::find($id);

        if (empty($post)) {
            return Response::json([
                'status' => 'error',
                'message' => 'Post not found',
            ], 404);
        }

        if ($post->update($inputData)) {
            return Response::json([
                'status' => 'success',
                'data' => [
                    'post' => $post,
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
        $post = Post::find($id);
        
        if (empty($post)) {
            return Response::json([
                'status' => 'error',
                'message' => 'Post not found',
            ], 404);
        }

        Post::destroy($id);

        return Response::json([
            'status' => 'success',
            'data' => null
        ], 200);
    }
}