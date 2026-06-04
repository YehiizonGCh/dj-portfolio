<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
{
    Schema::create('profiles', function (Blueprint $table) {
        $table->id();
        $table->string('dj_name');
        $table->string('real_name')->nullable();
        $table->text('bio');
        $table->text('bio_short')->nullable();
        $table->string('photo')->nullable();
        $table->string('email')->nullable();
        $table->string('phone')->nullable();
        $table->string('location')->nullable();
        $table->string('instagram')->nullable();
        $table->string('soundcloud')->nullable();
        $table->string('mixcloud')->nullable();
        $table->string('youtube')->nullable();
        $table->string('spotify')->nullable();
        $table->string('facebook')->nullable();
        $table->string('tiktok')->nullable();
        $table->integer('gigs_played')->default(0);
        $table->integer('countries')->default(0);
        $table->timestamps();
    });
}
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
