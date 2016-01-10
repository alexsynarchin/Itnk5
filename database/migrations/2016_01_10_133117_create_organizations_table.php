<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrganizationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organizations', function (Blueprint $table) {
            $table->increments('id');
            $table->text('full_name');
            $table->string('short_name');
            $table->string('inn');
            $table -> string('kpp');
            $table -> string('legal_address');
            $table ->string('fact_address');
            $table -> string('boss_position');
            $table ->string ('fio');
            $table ->date('date');
            $table ->string('contract_number');
            $table -> string('operate_foundation');
            $table -> integer('rs')->length(20)->unsigned();
            $table -> integer('ks')->length(20)->unsigned();
            $table -> integer('ls')->length(20)->unsigned();
            $table -> string('bank',50)->length(50);
            $table -> integer('bik')->length(9)->unsigned();
            $table -> string('phone')->length(15);
            $table -> string('email')->length(60);
            $table->integer('last_document_number')->unsigned();
            $table->decimal('org_carrying_amount', 25 , 2);
            $table->decimal('org_residual_value', 25 , 2);
            $table->decimal('org_movables_carrying_amount', 25 , 2);
            $table->decimal('org_value_movables_carrying_amount', 25 , 2);
            $table->decimal('org_buildings_carrying_amount', 25 , 2);
            $table->decimal('org_parcels_carrying_amount', 25 , 2);
            $table->decimal('org_movables_residual_value', 25 , 2);
            $table->decimal('org_value_movables_residual_value', 25 , 2);
            $table->decimal('org_buildings_residual_value', 25 , 2);
            $table->decimal('org_parcels_residual_value', 25 , 2);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('organizations');
    }
}
