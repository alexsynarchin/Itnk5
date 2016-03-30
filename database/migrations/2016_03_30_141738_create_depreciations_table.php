<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDepreciationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('depreciations', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->decimal('sum', 18, 2);
            $table->string('name');
            $table->string('number');
            $table->decimal('carrying_amount', 18, 2);
            $table->decimal('residual_value', 18, 2);
            $table->integer('item_id')->unsigned();
            $table->integer('report_id')->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('depreciations');
    }
}
