<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reports', function(Blueprint $table){
            $table->increments('id');
            $table->timestamps();
            $table->integer('year')->unsigned();
            $table->enum('quarter', [
                'first',
                'second',
                'third',
                'fourth'
            ]);
            $table->enum('state', [
                'accepted',
                'not_accepted',
                'inspection'
            ]);
            $table->integer('organization_id')->unsigned();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('reports');
    }
}
