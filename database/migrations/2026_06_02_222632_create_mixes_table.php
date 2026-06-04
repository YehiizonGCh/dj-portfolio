<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('mixes', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('genre')->nullable();
            $table->enum('platform', ['soundcloud', 'mixcloud', 'youtube'])->default('soundcloud');
            $table->string('embed_url');
            $table->string('cover_image')->nullable();
            $table->date('recorded_at')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mixes');
    }
};
