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
        Schema::create('event_and_tours', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Artist::class)->comment('foreign key refencing artist table')->constrained();
            $table->string('event_cover_photo');
            $table->string('venue');
            $table->boolean('ticket_availability')->nullable()->default(0);
            $table->dateTime('event_tour_date');
            $table->dateTime('event_date')->nullable();
            $table->boolean('is_active')->comment('1 Active, 0 inactive')->default('1');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_and_tours');
    }
};
