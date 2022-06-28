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
        Schema::create('tb_pemeriksaan_barang', function (Blueprint $table) {
            $table->id('id_pemeriksaan_barang');
            $table->string('no_pemeriksaan');
            $table->date('tanggal_pemeriksaan');
            $table->unsignedInteger('barang_masuk_id');
            $table->string('pemeriksa_1');
            $table->string('pemeriksa_2');
            $table->string('pemeriksa_3');
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
        Schema::dropIfExists('tb_pemeriksaan_barang');
    }
};
