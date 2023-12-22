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
        Schema::create('songs', function (Blueprint $table) {
            $table->id();
            $table->string('song_title');
            $table->foreignIdFor(\App\Models\User::class)->comment('Artist id')->constrained();
            $table->foreignIdFor(\App\Models\Album::class)->comment('Album id')->nullable()->constrained();
            $table->string('audio_url')->comment('save in s3');
            $table->string('producer');
            $table->boolean('is_active')->comment('1 Active, 0 inactive')->default('1');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('songs');
    }
};
