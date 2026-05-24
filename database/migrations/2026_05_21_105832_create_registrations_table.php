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
        Schema::create('registrations', function (Blueprint $table) {
           $table->id();
            $table->string('registration_id')->unique();
            $table->string('ticket_number')->unique();
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->integer('tickets_count');
            $table->text('notes')->nullable();
            $table->string('payment_screenshot')->nullable(); // path to file
            $table->string('payment_reference')->nullable();
            $table->enum('status', ['pending', 'confirmed'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registrations');
    }
};
