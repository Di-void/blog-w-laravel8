<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    // we have a post and it belongsTo a user

    public function user(){
        return $this->belongsTo(User::class);
    }

    // We have a Post and it belongs to a Category
    public function category (){
        return $this->belongsTo(Category::class);
    }
}
