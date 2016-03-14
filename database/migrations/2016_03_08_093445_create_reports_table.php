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
            $table->tinyInteger('quarter');
            $table->enum('state', [
                'not_accepted',
                'inspection',
                'accepted'
            ]);
            //carrying_amount
            $table->decimal('report_carrying_amount', 25, 2);
            $table->decimal('report_value_movables_carrying_amount', 25, 2);
            $table->decimal('report_movables_carrying_amount', 25, 2);
            $table->decimal('report_buildings_carrying_amount', 25, 2);
            $table->decimal('report_parcels_carrying_amount', 25, 2);
            $table->decimal('report_cars_carrying_amount', 25, 2);
            //residual_value
            $table->decimal('report_residual_value', 25, 2);
            $table->decimal('report_value_movables_residual_value', 25, 2);
            $table->decimal('report_movables_residual_value', 25, 2);
            $table->decimal('report_buildings_residual_value', 25, 2);
            $table->decimal('report_parcels_residual_value', 25, 2);
            $table->decimal('report_cars_residual_value', 25, 2);
            //wearout_value
            $table->decimal('report_wearout_value', 25, 2);
            $table->decimal('report_value_movables_wearout_value', 25, 2);
            $table->decimal('report_movables_wearout_value', 25, 2);
            $table->decimal('report_buildings_wearout_value', 25, 2);
            $table->decimal('report_parcels_wearout_value', 25, 2);
            $table->decimal('report_cars_wearout_value', 25, 2);
            //
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
