<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebLink extends Model
{
    use HasFactory;

    /**
     * El nombre de la tabla asociada con el modelo.
     *
     * @var string
     */
    protected $table = 'web_links';

    protected $fillable = [
        'name',
        'web_id',
        'status',
        'link',
    ];

    public function web(){
        return $this->belongsTo(Web::class);
    }
}
