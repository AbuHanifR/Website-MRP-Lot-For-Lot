<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailBomTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_bom', function (Blueprint $table) {
            $table->bigIncrements('id_detail_bom');
            $table->string('id_bom')->index()->nullable();
            $table->string('id_bahan_baku')->index()->nullable();
            $table->integer('jumlah_bahan');
            
            $table->foreign('id_bom')
            ->references('id_bom')
            ->on('bom')->onDelete('cascade');

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
        Schema::dropIfExists('detail_bom');
    }
}
