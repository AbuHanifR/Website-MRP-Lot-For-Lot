<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailMpsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_mps', function (Blueprint $table) {
            $table->increments('id_detail_mps');
            $table->string('id_mps')->index()->nullable();
            $table->unsignedBigInteger('id_detail_pesanan')->nullable();

            $table->date('jadwal_detail_produksi');
            

            $table->foreign('id_detail_pesanan')
            ->references('id_detail_pesanan')
            ->on('detail_pesanan')->onDelete('cascade');

            

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
        Schema::dropIfExists('detail_mps');
    }
}
