<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Web extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image',
        'description',
        'domain',
        'news_subdomain',
        'news_container_content_start',
        'news_container_content_end',
        'new_content_start',
        'new_content_end',
        'category_id',
    ];

    public function category(){
        return $this->belongsTo(Category::class);
    }
}
