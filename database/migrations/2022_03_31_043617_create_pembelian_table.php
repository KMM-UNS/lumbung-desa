<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePembelianTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pembelian', function (Blueprint $table) {
            $table->id();
            $table->integer('musim_id');
            $table->integer('tanaman_id');
            $table->string('petani_id');
            $table->integer('no_pembelian');
            $table->string('tanggal_pembelian');
            $table->integer('jumlah');
            // $table->integer('satuan_id');
            $table->string('kondisi_id');
            $table->string('harga');
            $table->string('total');
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
        Schema::dropIfExists('pembelian');
    }
}
