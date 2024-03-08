<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image',
        'description',
        'system_prompt',
        /* 'type', */
        'category_id',
        'subcategory'
    ];

    //public $enumType = ['general', 'política', 'tecnología'];

    public function post(){
        return $this->hasMany(Post::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }
}
