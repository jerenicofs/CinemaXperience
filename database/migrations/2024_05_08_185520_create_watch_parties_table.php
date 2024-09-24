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
        Schema::create('watch_parties', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('media_id');
            $table->foreign('media_id')->references('id')->on('medias')->onDelete('cascade')->onUpdate('cascade');
            $table->string('status', 50)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('watch_parties');
    }
};
