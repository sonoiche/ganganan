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
        Schema::create('assessment_clients', function (Blueprint $table) {
            $table->id();
            $table->integer('assessment_id');
            $table->integer('user_id');
            $table->bigInteger('correct')->nullable();
            $table->bigInteger('items')->nullable();
            $table->string('status')->nullable();
            $table->bigInteger('score')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assessment_clients');
    }
};
