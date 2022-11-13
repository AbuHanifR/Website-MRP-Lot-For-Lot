<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailBahanBakuMasukTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_bahan_baku_masuk', function (Blueprint $table) {
            $table->increments('id_detail_bahan_baku_masuk');
            $table->string('id_transaksi_masuk')->index()->nullable();
            $table->string('id_bahan_baku')->index()->nullable();
            $table->integer('jumlah_masuk');

            $table->foreign('id_transaksi_masuk')
            ->references('id_transaksi_masuk')
            ->on('bahan_baku_masuk')->onDelete('cascade');

            $table->foreign('id_bahan_baku')
            ->references('id_bahan_baku')
            ->on('bahan_baku')->onDelete('cascade');

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
        Schema::dropIfExists('detail_bahan_baku_masuk');
    }
}
