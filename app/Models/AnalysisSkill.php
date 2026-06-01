<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnalysisSkill extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'analysis_id',
        'skill_id',
        'matched',
        'match_score',
        'details',
    ];

    protected $casts = [
        'matched' => 'boolean',
        'match_score' => 'float',
        'details' => 'array',
    ];

    public function analysis()
    {
        return $this->belongsTo(Analysis::class);
    }

    public function skill()
    {
        return $this->belongsTo(Skill::class);
    }
}
