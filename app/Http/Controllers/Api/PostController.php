<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Helpers\PostHelper;
use Validator;

class PostController extends Controller
{

    public function getPosts() {
        $returnedFields = [
            'id',
            'theme',
            'message',
            'author_id',
        ];
        return PostHelper::getPosts($returnedFields);
    }

    public function getPostById($id) {
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
    
    public function update(Request $request) {
        $request->merge(['id' => $request->id]);

        $validator = Validator::make($request->all(), [
            'theme' => 'required|string|min:4|max:128',
            'message' => 'required|string|min:4|max:4000',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'fail',
                'data' => $validator->errors(),
            ], 400);
        }

        $inputData = $validator->validated();

        return PostHelper::update($request->id, $inputData);
    }
    
    public function delete($id) {
        return PostHelper::detele($id);
    }
}
