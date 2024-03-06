<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuthorDetail extends Model
{
    use HasFactory;
    
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'author_details';

    public $timestamps = false;

    protected $fillable = [
        'details',
        'author_general_id',
    ];

    public function general(){
        return $this->belongsTo(AuthorGeneral::class, 'author_general_id');
    }
}
