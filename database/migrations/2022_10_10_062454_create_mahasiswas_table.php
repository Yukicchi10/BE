<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Penting untuk tim lemon!!!
        // Penjelasan : yang di comment ini untuk template pembuatan migration
        // (WAJIB HAPUS COMMENT TEMPLATE JIKA TIDAK DIPAKAI) 
        Schema::create('mahasiswas', function (Blueprint $table) {
            $table->id('id');
            $table->unsignedBigInteger('idKelas')->nullable();
            // kode dibawah jika memiliki relasi sesuai dengan field rancangan database
            // $table->unsignedBigInteger('idNilai');
            // $table->unsignedBigInteger('idMapel');
            // $table->unsignedBigInteger('idAbsensi');
            // silahkan custom sendiri untuk database-nya, disesuaikan dengan rancangan
            $table->string('nama');
            $table->string('nim');
            $table->string('email');
            $table->string('password');
            $table->string('tempat')->nullable();
            $table->date('tgl_lahir')->nullable();
            $table->enum('jns_kelamin', ['laki-laki', 'perempuan'])->nullable();
            $table->string('agama')->nullable();
            $table->string('nama_ayah')->nullable();
            $table->string('nama_ibu')->nullable();
            $table->text('alamat');
            $table->string('telepon')->nullable();
            $table->string('kd_pos')->nullable();
            $table->timestamps();
            // Kode agar dapat berelasi dengan table lain

            // $table->foreign('A')->references('B')->on('C')

            // Keterangan :
            // - A (field yang memiliki relasi dengan table lain)
            // - B (field table sumber yang menjadi relasi)
            // - C (nama table yang menjadi sumber relasi)
            // ex : $table->foreign('idNilai')->references('idNilai')->on('nilas') 
        });

        Schema::table('mahasiswas', function (Blueprint $table) {
            $table->foreign('idKelas')->references('idKelas')->on('kelas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mahasiswas');
    }
};
