<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'canonical_name',
        'aliases',
        'category',
    ];

    protected $casts = [
        'aliases' => 'array',
    ];

    public function analyses()
    {
        return $this->belongsToMany(Analysis::class, 'analysis_skills')
            ->withPivot(['matched', 'match_score', 'details'])
            ->withTimestamps();
    }
}
