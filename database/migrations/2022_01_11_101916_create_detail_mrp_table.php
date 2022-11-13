<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailMrpTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_mrp', function (Blueprint $table) {
            $table->increments('id_detail_mrp');
            $table->string('id_mrp')->index()->nullable();
            $table->string('id_mps')->index()->nullable();
            $table->unsignedBigInteger('id_detail_bom')->nullable();
            $table->date('bulan_mrp');
            $table->integer('GR');
            $table->integer('SR');
            $table->integer('OHI');
            $table->integer('NR');
            $table->integer('POR');
            $table->integer('PORel');

            $table->foreign('id_mrp')
            ->references('id_mrp')
            ->on('mrp')->onDelete('cascade');

            $table->foreign('id_mps')
            ->references('id_mps')
            ->on('mps')->onDelete('cascade');

            $table->foreign('id_detail_bom')
            ->references('id_detail_bom')
            ->on('detail_bom')->onDelete('cascade');

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
        Schema::dropIfExists('detail_mrp');
    }
}
