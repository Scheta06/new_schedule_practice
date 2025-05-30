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
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->string('title');

            $table->foreignId('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreignId('mark_id')
                ->references('id')
                ->on('marks')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreignId('pattern_id')
                ->references('id')
                ->on('patterns')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreignId('generation_id')
                ->references('id')
                ->on('generations')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
