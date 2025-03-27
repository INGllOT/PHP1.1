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
        Schema::create('user_events', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->nullable();
                $table->foreignId('event_id');
                $table->string('name');
                $table->string('email');
                $table->integer(column: 'ticket_quantity');
                $table->timestamps(); 
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_events');
    }
};
