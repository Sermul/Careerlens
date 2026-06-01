<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Analysis extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'user_id',
        'resume_id',
        'job_description_id',
        'score_overall',
        'score_breakdown',
        'matched_skills',
        'missing_skills',
        'analysis_payload',
        'analyzed_at',
    ];

    protected $casts = [
        'score_overall' => 'float',
        'score_breakdown' => 'array',
        'matched_skills' => 'array',
        'missing_skills' => 'array',
        'analysis_payload' => 'array',
        'analyzed_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function resume()
    {
        return $this->belongsTo(Resume::class);
    }

    public function jobDescription()
    {
        return $this->belongsTo(JobDescription::class);
    }

    public function aiSuggestion()
    {
        return $this->hasOne(AiSuggestion::class);
    }

    public function skills()
    {
        return $this->belongsToMany(Skill::class, 'analysis_skills')
            ->withPivot(['matched', 'match_score', 'details'])
            ->withTimestamps();
    }
}
