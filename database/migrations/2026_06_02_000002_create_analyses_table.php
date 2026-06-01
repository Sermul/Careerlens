<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('analyses', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->uuid('resume_id');
            $table->uuid('job_description_id');
            $table->decimal('score_overall', 5, 2)->nullable();
            $table->jsonb('score_breakdown')->nullable();
            $table->jsonb('matched_skills')->nullable();
            $table->jsonb('missing_skills')->nullable();
            $table->jsonb('analysis_payload')->nullable();
            $table->timestamp('analyzed_at')->nullable();
            $table->timestamps();

            $table->foreign('resume_id')->references('id')->on('resumes')->cascadeOnDelete();
            $table->foreign('job_description_id')->references('id')->on('job_descriptions')->cascadeOnDelete();
            $table->index(['user_id', 'resume_id', 'job_description_id']);
            $table->index('analyzed_at');
            $table->index('score_overall');
            $table->index('score_breakdown', 'analyses_score_breakdown_gin', 'gin');
            $table->index('matched_skills', 'analyses_matched_skills_gin', 'gin');
            $table->index('missing_skills', 'analyses_missing_skills_gin', 'gin');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('analyses');
    }
};
