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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\EventAndTour::class)->comment('foreign key refencing event table')->constrained();
            $table->foreignIdFor(\App\Models\Artist::class)->comment('foreign key refencing artist table')->constrained();
            $table->string('amount');
            $table->boolean('is_active')->comment('1 Active, 0 inactive')->default('1');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
