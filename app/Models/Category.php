<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'image',
        'text',
        'color'
    ];

    public function Post(){
        return $this->hasMany(Post::class);
    }

    public function Author(){
        return $this->hasMany(Author::class);
    }

    public function Web(){
        return $this->hasMany(Web::class);
    }
}
