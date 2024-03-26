<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OpenAiChatModel extends Model
{
    use HasFactory;

    /**
     * El nombre de la tabla asociada con el modelo.
     *
     * @var string
     */
    protected $table = 'openai_chat_models';

    protected $fillable = [
        'name',
        'model_name',
        'temperature',
        'max_tokens',
        'top_p',
        'using'
    ];
}
