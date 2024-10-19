<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pelamar', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Foreign key untuk menghubungkan dengan users
            $table->string('nik')->unique(); // NIK
            $table->string('noLamaran')->unique();
            $table->string('nama_lengkap'); // Nama Lengkap
            $table->string('tempat_lahir')->nullable(); // Tempat Lahir
            $table->date('tanggal_lahir')->nullable(); // Tanggal Lahir
            $table->enum('jenis_kelamin', ['Laki-Laki', 'Perempuan'])->nullable(); // Jenis Kelamin
            $table->integer('tinggi_badan')->nullable(); // Tinggi Badan
            $table->integer('berat_badan')->nullable(); // Berat Badan
            $table->string('no_hp')->nullable(); // No. HP
            $table->string('email')->nullable(); // Email
            // $table->string('email')->nullable()->change();
            $table->string('profile_picture')->nullable(); // Profile Picture
            $table->string('negara')->nullable(); // Negara
            $table->string('provinsi')->nullable(); // Provinsi
            $table->string('kota')->nullable(); // Kota/Kabupaten
            $table->string('kecamatan')->nullable(); // Kecamatan
            $table->string('kelurahan')->nullable(); // Kelurahan
            $table->text('alamat_ktp')->nullable(); // Alamat KTP
            $table->string('rt')->nullable(); // RT
            $table->string('rw')->nullable(); // RW
            $table->string('kode_pos')->nullable(); // Kode Pos
            $table->string('jenjang_pendidikan')->nullable(); // Jenjang Pendidikan
            $table->string('nama_institusi')->nullable(); // Nama Institusi
            $table->string('jurusan')->nullable(); // Jurusan
            $table->year('tahun_masuk')->nullable(); // Tahun Masuk
            $table->year('tahun_lulus')->nullable(); // Tahun Lulus
            $table->decimal('ipk', 3, 2)->nullable(); // IPK
            $table->string('cv')->nullable(); // curiculum vitae
            $table->timestamps(); // Timestamps
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pelamar');
    }
};
