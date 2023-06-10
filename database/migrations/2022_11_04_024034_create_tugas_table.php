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
            $table->id();
            $table->unsignedBigInteger('id_kelas');
            $table->unsignedBigInteger('id_mapel');
            $table->unsignedBigInteger('id_dosen')->nullable();
            $table->string('title');
            $table->string('description');
            $table->timestamps();
        });

        Schema::table('tugas', function (Blueprint $table) {
            $table->foreign('id_kelas')->references('id')->on('kelas');
            $table->foreign('id_mapel')->references('id')->on('mata_pelajarans');
            $table->foreign('id_dosen')->references('id')->on('dosens')
            ->onDelete('set null');
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
