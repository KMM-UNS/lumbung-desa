<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDaftarProduksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('daftar_produks', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('kondisi');
            $table->string('keterangan');
            $table->string('harga_beli');
            $table->string('harga_jual');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('daftar_produks');
    }
}
