<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuthorPerson extends Model
{
    use HasFactory;
    
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'author_persons';

    public $timestamps = false;

    protected $fillable = [
        /* 'name',
        'surname',
        /* 'image', */
        /* 'extra', */
        'username',
        'author_general_id',
        'choices',
        'other',
    ];

    public $enumChoices = ['ad', 'post', 'course', 'movie', 'other'];
    
    public function general(){
        return $this->belongsTo(AuthorGeneral::class);
    }
}
