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
        Schema::create('tb_pangkat', function (Blueprint $table) {
            $table->id('id_pangkat');
            $table->string('nama_pangkat');
            $table->string('golongan');
            $table->double('gaji_pokok');
            $table->string('potongan');
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
        Schema::dropIfExists('tb_pangkat');
    }
};
