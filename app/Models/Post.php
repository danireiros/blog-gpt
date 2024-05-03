<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        //'date',
        'image',
        'text',
        'description',
        'posted',
        'type',
        'category_id',
        'author_id'
    ];

    public $enumPosted = ['publicado','rechazado','pendiente'];
    public $enumType = ['#ad', 'post'];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function author(){
        return $this->belongsTo(Author::class);
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }

    public function tags(){
        return $this->morphToMany(Tag::class, 'taggable');
    }
}
