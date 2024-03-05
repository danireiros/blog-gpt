<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuthorGeneral extends Model
{
    use HasFactory;
    
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'author_generals';

    public $timestamps = false;

    protected $fillable = [
        'name',
        'description',
        'type',
    ];

    public $enumType = ['person', 'company'];

    public function person()
    {
        return $this->hasOne(AuthorPerson::class);
    }

    public function company()
    {
        return $this->hasOne(AuthorCompany::class);
    }

    public function detail()
    {
        return $this->hasOne(AuthorDetail::class);
    }
}
