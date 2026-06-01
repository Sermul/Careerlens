<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('skills', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('canonical_name')->unique();
            $table->jsonb('aliases')->nullable();
            $table->string('category')->nullable();
            $table->timestamps();

            $table->index('category');
            $table->index('aliases', 'skills_aliases_gin', 'gin');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('skills');
    }
};
