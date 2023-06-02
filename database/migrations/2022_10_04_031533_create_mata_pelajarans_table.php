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
        Schema::create('mata_pelajarans', function (Blueprint $table) {
            $table->id('id');
            $table->unsignedBigInteger('id_class');
            $table->unsignedBigInteger('id_dosen');
            $table->string('nama_mapel');
            $table->string('deskripsi_mapel');
            $table->string('day');
            $table->string('start_time');
            $table->string('end_time');
            $table->timestamps();

            $table->foreign('id_class')->references('id')->on('kelas');
            $table->foreign('id_dosen')->references('id')->on('dosens');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mata_pelajarans');
    }
};
