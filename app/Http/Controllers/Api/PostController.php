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
            'id',
            'theme',
            'message',
            'author_id',
        ];
        return PostHelper::getPostById($id, $returnedFields);
    }

}
