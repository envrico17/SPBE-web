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
        Schema::create('score_indicators', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('score_id');
            $table->unsignedBigInteger('indicator_id');
            $table->integer('score')->nullable();
            $table->text('score_description')->nullable();
            $table->timestamps();
            $table->foreign('score_id')
                ->references('id')->on('scores')->onDelete('cascade');
            $table->foreign('indicator_id')
                ->references('id')->on('indicators')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('score_indicators');
    }
};
