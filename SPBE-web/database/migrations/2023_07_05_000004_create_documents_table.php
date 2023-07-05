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
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('indicator_id');
            $table->string('doc_name');
            $table->string('upload_path')->nullable();
            $table->timestamps();
            $table->foreign('user_id')
                ->references('id')->on('users')->onDelete('cascade');
            $table->foreign('indicator_id')
                ->references('id')->on('indicators')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};
