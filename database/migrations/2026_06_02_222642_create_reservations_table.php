<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->string('client_name');
            $table->string('client_email');
            $table->string('client_phone')->nullable();
            $table->string('event_type');
            $table->date('event_date');
            $table->string('event_location');
            $table->string('budget_range')->nullable();
            $table->text('message')->nullable();
            $table->enum('status', ['pending', 'confirmed', 'rejected'])->default('pending');
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
