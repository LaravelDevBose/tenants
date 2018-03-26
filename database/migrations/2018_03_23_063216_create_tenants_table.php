<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTenantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tenants', function (Blueprint $table) {
            $table->increments('id');
            $table->string('id_number',100);
            $table->string('full_name',100);
            $table->string('phone_number',100)->nullable();
            $table->string('email_address',100)->nullable();
            $table->text('image')->nullable();
            $table->string('plot_name_number',100)->nullable();
            $table->string('house_name_number',100)->nullable();
            $table->string('room_type',5)->nullable();
            $table->unsignedInteger('rent_amount');
            $table->unsignedInteger('balance')->nullable();
            $table->unsignedInteger('gas_bill')->nullable();
            $table->unsignedInteger('water_bill')->nullable();
            $table->unsignedInteger('net_bill')->nullable();
            $table->unsignedInteger('other_bill')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->text('address')->nullable();
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
        Schema::dropIfExists('tenants');
    }
}
