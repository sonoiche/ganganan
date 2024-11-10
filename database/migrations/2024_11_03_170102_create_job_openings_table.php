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
        Schema::create('job_openings', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('job_order_number');
            $table->string('job_title');
            $table->text('job_description')->nullable();
            $table->bigInteger('workers_need')->nullable();
            $table->enum('workers_gender', ['Male', 'Gender', 'Any'])->nullable();
            $table->enum('status', ['Draft','Publish'])->nullable();
            $table->decimal('salary', 8, 2)->nullable();
            $table->enum('salary_rate', ['Hourly','Daily'])->nullable();
            $table->date('date_needed')->nullable();
            $table->date('date_until')->nullable();
            $table->text('skills')->nullable();
            $table->string('photo')->nullable();
            $table->string('location')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_openings');
    }
};
