<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuthorCompany extends Model
{
    use HasFactory;
    
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'author_companies';

    public $timestamps = false;

    protected $fillable = [
        /* 'name', */
        'CIF',
        'email',
        'extra',
        'image',
        'author_general_id',
        'choices',
    ];

    public $enumChoices = ['ad', 'post', 'course', 'movie', 'other'];

    public function general(){
        return $this->belongsTo(AuthorGeneral::class);
    }
}
