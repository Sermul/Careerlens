<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('resumes', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->string('title')->nullable();
            $table->string('filename');
            $table->text('storage_path');
            $table->bigInteger('size_bytes')->unsigned()->nullable();
            $table->jsonb('metadata')->nullable();
            $table->unsignedInteger('version')->default(1);
            $table->timestamp('uploaded_at')->useCurrent();
            $table->softDeletes();
            $table->timestamps();

            $table->index(['user_id', 'uploaded_at']);
            $table->index('uploaded_at');
            $table->index(['user_id', 'deleted_at']);
            $table->index('metadata', 'resumes_metadata_gin', 'gin');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('resumes');
    }
};
