<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailPesananTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_pesanan', function (Blueprint $table) {
            $table->bigIncrements('id_detail_pesanan');
            
            $table->string('id_pesanan')->index()->nullable();
            $table->string('id_produk')->index()->nullable();
            $table->integer('jumlah_pesanan');
                        
            $table->foreign('id_pesanan')
            ->references('id_pesanan')
            ->on('penerimaan_pesanan')->onDelete('cascade');

            $table->foreign('id_produk')
            ->references('id_produk')
            ->on('produk')->onDelete('cascade');

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
        Schema::dropIfExists('detail_pesanan');
    }
}
