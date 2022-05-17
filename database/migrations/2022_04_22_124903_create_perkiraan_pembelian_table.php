<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePerkiraanPembelianTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('perkiraan_pembelian', function (Blueprint $table) {
            $table->id();
            $table->integer('musim_id');
            $table->integer('tanaman_id');
            $table->string('petani_id');
            $table->string('lahan_id');
            $table->string('luas_lahan');
            $table->integer('jumlah');
            $table->integer('satuan_id');
            $table->string('kondisi_id');
            $table->string('harga');
            $table->string('total');
            $table->softDeletes();
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
        Schema::dropIfExists('perkiraan_pembelian');
    }
}
