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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('description');
            $table->string('place');
            $table->decimal('ticket_price', 8, 2);
            $table->integer('ticket_quantity');
            $table->dateTime('event_date');
            $table->dateTime('ticket_start_date');
            $table->dateTime('ticket_end_date');
            $table->string('category');
            $table->integer('user_id');
            $table->string('color');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
