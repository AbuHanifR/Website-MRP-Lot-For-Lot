<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMpsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mps', function (Blueprint $table) {
            $table->string('id_mps',10);
            $table->primary('id_mps');
            $table->string('id_produk')->index()->nullable();
            $table->date('bulan');
            $table->integer('minggu_1');
            $table->integer('minggu_2');
            $table->integer('minggu_3');
            $table->integer('minggu_4');

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
        Schema::dropIfExists('mps');
    }
}
