<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

use App\Models\Post;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    
    public $timestamps = false;

    protected $fillable = [
        'user_name',
        'login',
        'password'
    ];

    protected $hidden = [
        'password',
        '_token',
    ];

    public function posts() {
        return $this->hasMany(Post::class, 'author_id');
    }
}
