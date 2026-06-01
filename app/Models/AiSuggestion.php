<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AiSuggestion extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'analysis_id',
        'prompt',
        'response',
        'tokens_used',
        'model_meta',
    ];

    protected $casts = [
        'response' => 'array',
        'model_meta' => 'array',
    ];

    public function analysis()
    {
        return $this->belongsTo(Analysis::class);
    }
}
