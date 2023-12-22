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
        Schema::create('music_downloads', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\User::class)->comment('foreign key refencing user_id table')->constrained();
            $table->foreignIdFor(\App\Models\Song::class)->comment('foreign key refencing song table')->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('music_downloads');
    }
};
