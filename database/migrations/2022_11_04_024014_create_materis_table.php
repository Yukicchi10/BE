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
            $table->id();
            $table->unsignedBigInteger('createdBy')->nullable();
            $table->unsignedBigInteger('id_mapel');
            $table->unsignedBigInteger('id_kelas');
            $table->string('judul');
            $table->string('deskripsi');
            $table->string('file')->nullable();

            $table->timestamps();
        });

        Schema::table('materis', function (Blueprint $table) {
            $table->foreign('createdBy')->references('id')->on('dosens')
            ->onDelete('set null');
            $table->foreign('id_mapel')->references('id')->on('mata_pelajarans');
            $table->foreign('id_kelas')->references('id')->on('kelas');
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
