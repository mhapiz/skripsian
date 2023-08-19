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
        Schema::create('tb_inventaris', function (Blueprint $table) {
            $table->id('id_inventaris');
            $table->unsignedInteger('barang_id');
            $table->integer('register');
            $table->string('kondisi');
            $table->string('tahun_masuk');
            $table->string('jenis_kepemilikan')->nullable();
            $table->unsignedInteger('ruangan_id')->nullable();
            $table->unsignedInteger('pegawai_id')->nullable();
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
        Schema::dropIfExists('tb_inventaris');
    }
};
