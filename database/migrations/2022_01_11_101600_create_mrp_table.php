<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMrpTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mrp', function (Blueprint $table) {
            $table->string('id_mrp',10);
            $table->primary('id_mrp');
            $table->string('id_produk')->index()->nullable();
            
            
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
        Schema::dropIfExists('mrp');
    }
}
