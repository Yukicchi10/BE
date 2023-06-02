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
        Schema::create('mahasiswas', function (Blueprint $table) {
            $table->id('id');
            $table->unsignedBigInteger('id_user');
            $table->unsignedBigInteger('id_class');
            $table->string('nama');
            $table->string('nim');
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

            $table->foreign('id_user')->references('id')->on('users');
            $table->foreign('id_class')->references('id')->on('kelas');
            // Keterangan :
            // - A (field yang memiliki relasi dengan table lain)
            // - B (field table sumber yang menjadi relasi)
            // - C (nama table yang menjadi sumber relasi)
            // ex : $table->foreign('idNilai')->references('idNilai')->on('nilas') 
        });

        // Schema::table('mahasiswas', function (Blueprint $table) {
        //     $table->foreign('idKelas')->references('id')->on('kelas');
        // });
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
