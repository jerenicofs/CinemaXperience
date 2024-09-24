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
        Schema::create('media_casts', function (Blueprint $table) {
            $table->unsignedBigInteger('media_id');
            $table->unsignedBigInteger('cast_id');
            $table->primary(['media_id', 'cast_id']);
            $table->foreign('media_id')->references('id')->on('medias')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('cast_id')->references('id')->on('casts')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('media_casts');
    }
};
