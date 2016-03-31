<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InsertTotalValuesInReportTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('reports', function (Blueprint $table) {
            $table->decimal('report_total_carrying_amount', 27, 2);
            $table->decimal('report_total_residual_value', 27, 2);
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
            $table->decimal('report_wearout_carrying_amount', 25, 2);
            $table->decimal('report_wearout_residual_value', 25, 2);
            $table->decimal('report_value_movables_wearout_value', 25, 2);
            $table->decimal('report_movables_wearout_value', 25, 2);
            $table->decimal('report_buildings_wearout_value', 25, 2);
            $table->decimal('report_parcels_wearout_value', 25, 2);
            $table->decimal('report_cars_wearout_value', 25, 2);
            //
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('reports', function (Blueprint $table) {
        $table->dropColumn('report_total_carrying_amount','report_total_residual_value','report_carrying_amount','report_value_movables_carrying_amount','report_movables_carrying_amount', 'report_buildings_carrying_amount', 'report_parcels_carrying_amount', 'report_cars_carrying_amount','report_residual_value', 'report_value_movables_residual_value', 'report_movables_residual_value', 'report_buildings_residual_value', 'report_parcels_residual_value', 'report_cars_residual_value',  'report_wearout_value', 'report_value_movables_wearout_value', 'report_movables_wearout_value', 'report_buildings_wearout_value', 'report_parcels_wearout_value', 'report_cars_wearout_value','report_wearout_carrying_amount', 'report_wearout_residual_value');
    });
    }
}
