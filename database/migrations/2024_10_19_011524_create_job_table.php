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
        Schema::create('job', function (Blueprint $table) {
            $table->id();
            $table->string('job_name');
            $table->integer('maximum_age');
            $table->string('minimum_education');
            $table->string('major');
            $table->string('salary');
            $table->date('open_date');
            $table->date('close_date');
            $table->text('job_desc');
            $table->text('job_criteria');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job');
    }
};
