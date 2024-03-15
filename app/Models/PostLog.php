<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostLog extends Model
{
    use HasFactory;

    /**
     * El nombre de la tabla asociada con el modelo.
     *
     * @var string
     */
    protected $table = 'posts_log';

    protected $fillable = [
        'domain',
        'subdomain',
        'posts_found',
        'posts_generated'
    ];
}
