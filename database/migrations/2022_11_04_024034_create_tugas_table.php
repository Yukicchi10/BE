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
        Schema::create('tugas', function (Blueprint $table) {
            $table->id('idTugas');
            $table->unsignedBigInteger('idMateri');
            $table->string('judul_tugas');
            $table->string('deskripsi_tugas');
            $table->timestamps();
        });

        Schema::table('tugas', function (Blueprint $table) {
            $table->foreign('idMateri')->references('idMateri')->on('materis');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tugas');
    }
};
