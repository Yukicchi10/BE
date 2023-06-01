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
        Schema::create('materis', function (Blueprint $table) {
            $table->id('idMateri');
            $table->unsignedBigInteger('createdBy');
            $table->unsignedBigInteger('idMapel');
            $table->unsignedBigInteger('idKelas');
            $table->string('judul');
            $table->string('deskripsi');
            $table->string('file')->nullable();

            $table->timestamps();
        });

        Schema::table('materis', function (Blueprint $table) {
            $table->foreign('createdBy')->references('id')->on('dosens');
            $table->foreign('idMapel')->references('idMapel')->on('mata_pelajarans');
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
        Schema::dropIfExists('materis');
    }
};
