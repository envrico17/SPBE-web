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
        Schema::create('indicators', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('aspect_id');
            $table->unsignedBigInteger('score_id');
            $table->integer('score')->nullable();
            $table->string('indicator_name');
            $table->text('description')->nullable();
            $table->timestamps();
            $table->foreign('aspect_id')
                ->references('id')->on('aspects')->onDelete('cascade');
            $table->foreign('score_id')
                ->references('id')->on('scores')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('indicators');
    }
};
