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
            $table->string('tgl_lahir')->nullable();
            $table->enum('jns_kelamin', ['laki-laki', 'perempuan'])->nullable();
            $table->string('agama')->nullable();
            $table->string('nama_ayah')->nullable();
            $table->string('nama_ibu')->nullable();
            $table->text('alamat');
            $table->string('telepon')->nullable();
            $table->string('kd_pos')->nullable();
            $table->timestamps();
            
            $table->foreign('id_user')->references('id')->on('users');
            $table->foreign('id_class')->references('id')->on('kelas');
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
