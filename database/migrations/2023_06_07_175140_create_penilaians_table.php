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
        Schema::create('penilaians', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_pegawai');
            $table->foreign('id_pegawai')->references('id')->on('pegawais')->onDelete('cascade');

            $table->date('tanggal_penilaian');
            $table->unsignedBigInteger('id_kriteria1')->nullable();
            $table->foreign('id_kriteria1')->references('id')->on('kriterias')->onDelete('cascade');

            $table->unsignedBigInteger('id_kriteria2')->nullable();
            $table->foreign('id_kriteria2')->references('id')->on('kriterias')->onDelete('cascade');

            $table->unsignedBigInteger('id_kriteria3')->nullable();
            $table->foreign('id_kriteria3')->references('id')->on('kriterias')->onDelete('cascade');

            $table->unsignedBigInteger('id_kriteria4')->nullable();
            $table->foreign('id_kriteria4')->references('id')->on('kriterias')->onDelete('cascade');

            $table->unsignedBigInteger('id_kriteria5')->nullable();
            $table->foreign('id_kriteria5')->references('id')->on('kriterias')->onDelete('cascade');

            $table->unsignedBigInteger('id_kriteria6')->nullable();
            $table->foreign('id_kriteria6')->references('id')->on('kriterias')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('penilaians');
    }
};
