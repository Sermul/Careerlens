<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ai_suggestions', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('analysis_id');
            $table->text('prompt');
            $table->jsonb('response')->nullable();
            $table->integer('tokens_used')->unsigned()->nullable();
            $table->jsonb('model_meta')->nullable();
            $table->timestamps();

            $table->foreign('analysis_id')->references('id')->on('analyses')->cascadeOnDelete();
            $table->unique('analysis_id');
            $table->index('analysis_id');
            $table->index('model_meta', 'ai_suggestions_model_meta_gin', 'gin');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ai_suggestions');
    }
};
