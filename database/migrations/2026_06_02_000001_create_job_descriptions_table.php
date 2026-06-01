<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('job_descriptions', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->string('title');
            $table->text('content');
            $table->jsonb('metadata')->nullable();
            $table->timestamps();

            $table->index(['user_id', 'created_at']);
            $table->index('created_at');
            $table->index('user_id');
            $table->index('metadata', 'job_descriptions_metadata_gin', 'gin');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('job_descriptions');
    }
};
