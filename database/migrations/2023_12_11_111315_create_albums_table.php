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
        Schema::create('albums', function (Blueprint $table) {
            $table->id();
            $table->string('album_title')->unique();
            $table->foreignIdFor(\App\Models\Artist::class)->comment('artist id')->constrained();
            $table->dateTime('release_date')->nullable();
            $table->string('cover_image_url');
            $table->boolean('is_active')->comment('1 Active, 0 inactive')->default('1');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('albums');
    }
};
