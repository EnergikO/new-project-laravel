<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Post;

class User extends Model
{
    use HasFactory;
    
    public $timestamps = false;

    public function posts() {
        return $this->hasMany(Post::class, 'author_id');
    }
}
