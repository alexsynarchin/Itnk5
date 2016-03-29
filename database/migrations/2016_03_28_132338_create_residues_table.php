<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResiduesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('residues', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('state', [
                'not_accepted',
                'inspection',
                'accepted'
            ]);
            //carrying_amount
            $table->decimal('residue_carrying_amount', 25, 2);
            $table->decimal('residue_value_movables_carrying_amount', 25, 2);
            $table->decimal('residue_movables_carrying_amount', 25, 2);
            $table->decimal('residue_buildings_carrying_amount', 25, 2);
            $table->decimal('residue_parcels_carrying_amount', 25, 2);
            $table->decimal('residue_cars_carrying_amount', 25, 2);
            //residual_value
            $table->decimal('residue_residual_value', 25, 2);
            $table->decimal('residue_value_movables_residual_value', 25, 2);
            $table->decimal('residue_movables_residual_value', 25, 2);
            $table->decimal('residue_buildings_residual_value', 25, 2);
            $table->decimal('residue_parcels_residual_value', 25, 2);
            $table->decimal('residue_cars_residual_value', 25, 2);
            //wearout_value
            $table->decimal('residue_wearout_value', 25, 2);
            $table->decimal('residue_value_movables_wearout_value', 25, 2);
            $table->decimal('residue_movables_wearout_value', 25, 2);
            $table->decimal('residue_buildings_wearout_value', 25, 2);
            $table->decimal('residue_parcels_wearout_value', 25, 2);
            $table->decimal('residue_cars_wearout_value', 25, 2);
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
        Schema::drop('residues');
    }
}
