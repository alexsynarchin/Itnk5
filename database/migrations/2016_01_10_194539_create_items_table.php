<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('name');
            $table->string('number');
            $table->date('os_date');
            $table->decimal('carrying_amount', 15, 2);
            $table->enum('financing_source',array(
                'budget',
                'out_budget'
            ));
            $table->string('os_view');
            $table->integer('okof');
            $table->text('additional_field');
            $table->integer('document_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('items');
    }
}
