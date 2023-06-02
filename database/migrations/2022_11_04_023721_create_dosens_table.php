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
        Schema::create('dosens', function (Blueprint $table) {
            $table->id('id');
            $table->unsignedBigInteger('id_user');
            $table->string('nama');
            $table->string('nidn');
            $table->string('tempat')->nullable();
            $table->string('tgl_lahir')->nullable();
            $table->enum('jns_kelamin', ['laki-laki', 'perempuan'])->nullable();
            $table->string('agama')->nullable();
            $table->text('alamat');
            $table->string('telepon')->nullable();
            $table->string('kd_pos')->nullable();
            $table->timestamps();

            // Schema::table('dosens', function (Blueprint $table) {
                $table->foreign('id_user')->references('id')->on('users');
            // });
            // Kode agar dapat berelasi dengan table lain

            // $table->foreign('A')->references('B')->on('C')

            // Keterangan :
            // - A (field yang memiliki relasi dengan table lain)
            // - B (field table sumber yang menjadi relasi)
            // - C (nama table yang menjadi sumber relasi)
            // ex : $table->foreign('idNilai')->references('idNilai')->on('nilas') 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dosens');
    }
};
