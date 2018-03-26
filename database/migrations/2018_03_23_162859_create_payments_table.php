<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('tenant_id');
            $table->unsignedInteger('rent_amount');
            $table->unsignedInteger('gas_bill')->nullable();
            $table->unsignedInteger('water_bill')->nullable();
            $table->unsignedInteger('net_bill')->nullable();
            $table->unsignedInteger('other_bill')->nullable();
            $table->unsignedInteger('total_amount')->nullable();
            $table->unsignedSmallInteger('status')->nullable();
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
        Schema::dropIfExists('payments');
    }
}
