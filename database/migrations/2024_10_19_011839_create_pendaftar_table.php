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
        Schema::create('pendaftar', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Foreign key untuk menghubungkan dengan users
            $table->string('name');
            $table->string('email');
            // Ubah 'job' menjadi 'career'
            $table->foreignId('job_id')->constrained('careers')->onDelete('cascade');
            $table->date('application_date');
            $table->enum('status', ['pending', 'tes', 'interview','mcu', 'diterima', 'ditolak'])->default('pending');
            $table->datetime('tanggal_tes')->nullable();
            $table->datetime('tanggal_interview')->nullable();
            $table->datetime('tanggal_mcu')->nullable();
            $table->string('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendaftar');
    }
};
