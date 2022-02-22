<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Helpers\PostHelper;

class PostController extends Controller
{

    public function getPosts()
    {
        $returnedFields = [
            'id',
            'theme',
            'message',
            'author_id',
        ];
        return PostHelper::getPosts($returnedFields);
    }

    public function getPostById($id)
    {
        $returnedFields = [
            'theme',
            'message',
            'author_id',
        ];
        return PostHelper::getPostById($id, $returnedFields);
    }

    public function getPostsByAuthorId($author_id) {
        $returnedFields = [
            'theme',
            'message',
        ];
        return PostHelper::getPostsByAuthorId($author_id, $returnedFields);
    }

    public function add(Request $request) {
        $validator = Validator::make($request->all(), [
            'theme' => 'required|string|min:4|max:128',
            'message' => 'required|string|min:4|max:4000',
            'author_id' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'fail',
                'data' => $validator->errors(),
            ], 400);
        }

        $inputData = $validator->validated();

        return PostHelper::add($inputData);
    }
}
