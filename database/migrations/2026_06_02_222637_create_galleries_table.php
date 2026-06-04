<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('galleries', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->enum('type', ['photo', 'video'])->default('photo');
            $table->string('file_path');
            $table->string('thumbnail')->nullable();
            $table->text('caption')->nullable();
            $table->foreignId('event_id')->nullable()->constrained()->nullOnDelete();
            $table->integer('order')->default(0);
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('galleries');
    }
};
