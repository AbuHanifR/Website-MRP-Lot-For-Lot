<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailBahanBakuKeluarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_bahan_baku_keluar', function (Blueprint $table) {
            $table->increments('id_detail_bahan_baku_keluar');
            $table->string('id_transaksi_keluar')->index()->nullable();
            $table->string('id_bahan_baku')->index()->nullable();
            $table->integer('jumlah_keluar');
            

            $table->foreign('id_transaksi_keluar')
            ->references('id_transaksi_keluar')
            ->on('bahan_baku_keluar')->onDelete('cascade');

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
        Schema::dropIfExists('detail_bahan_baku_keluar');
    }
}
