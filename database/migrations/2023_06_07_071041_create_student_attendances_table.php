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
        Schema::create('student_attendances', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_pertemuan');
            $table->unsignedBigInteger('id_mahasiswa');
            $table->enum('status', ['Hadir', 'Sakit', 'Izin', 'Tanpa Keterangan','-'])->nullable();
            $table->timestamps();

            $table->foreign('id_pertemuan')->references('id')->on('attendances'); 
            $table->foreign('id_mahasiswa')->references('id')->on('mahasiswas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student_attendances');
    }
};
