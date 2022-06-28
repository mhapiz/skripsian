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
        Schema::create('tb_serah_terima', function (Blueprint $table) {
            $table->id('id_serah_terima');
            $table->string('no_serah_terima');
            $table->date('tanggal_serah_terima');
            $table->unsignedInteger('ruangan_id');
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
        Schema::dropIfExists('tb_serah_terima');
    }
};
