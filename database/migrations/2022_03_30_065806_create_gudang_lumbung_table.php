<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGudangLumbungTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gudang_lumbung', function (Blueprint $table) {
            $table->id();
            $table->string('nama_tanaman_id');
            $table->string('jenis_tanaman_id');
            $table->string('stok');
            $table->string('satuan');
            $table->string('kondisi_id');
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
        Schema::dropIfExists('gudang_lumbung');
    }
}
