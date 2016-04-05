<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDecommissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('decommissions', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('name');
            $table->string('number');
            $table->decimal('carrying_amount', 18, 2);
            $table->decimal('sum', 18, 2);
            $table->date('date');
            $table->text('document');
            $table->enum('type',[
                'sale',
                'gratuitous transfer',
                'decommission'
            ]);
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
        Schema::drop('decommissions');
    }
}
