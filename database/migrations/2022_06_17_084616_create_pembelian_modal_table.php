<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePembelianModalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pembelian_modal', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('musim_panen_id')->unsigned();
            $table->integer('tanaman_id');
            $table->string('petani_id');
            $table->string('lahan_id');
            $table->string('luas_lahan');
            $table->integer('jumlah');
            $table->integer('satuan_id');
            $table->string('kondisi_id');
            $table->string('harga');
            $table->string('total');
            $table->timestamps();

            $table->foreign('musim_panen_id')->references('id')->on('perkiraan_pembelian')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pembelian_modal');
    }
}
