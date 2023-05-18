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
        Schema::create('tugas_murids', function (Blueprint $table) {
            $table->id('idTugasMurid');
            $table->unsignedBigInteger('idTugas');
            $table->unsignedBigInteger('idMahasiswa');
            $table->string('file');
            $table->string('nilai');
            $table->enum('status', ['selesai', 'belum selesai']);
            $table->timestamps();
        });

        Schema::table('tugas_murids', function (Blueprint $table) {
            $table->foreign('idTugas')->references('idTugas')->on('tugas');
            $table->foreign('idMahasiswa')->references('idMahasiswa')->on('mahasiswas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tugas_murids');
    }
};
