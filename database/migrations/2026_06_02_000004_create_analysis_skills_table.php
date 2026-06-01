<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('analysis_skills', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('analysis_id');
            $table->uuid('skill_id');
            $table->boolean('matched')->default(false);
            $table->decimal('match_score', 5, 3)->nullable();
            $table->jsonb('details')->nullable();
            $table->timestamps();

            $table->foreign('analysis_id')->references('id')->on('analyses')->cascadeOnDelete();
            $table->foreign('skill_id')->references('id')->on('skills')->cascadeOnDelete();
            $table->unique(['analysis_id', 'skill_id']);
            $table->index('analysis_id');
            $table->index('skill_id');
            $table->index('matched');
            $table->index('details', 'analysis_skills_details_gin', 'gin');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('analysis_skills');
    }
};
