<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDriversTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('drivers', function (Blueprint $table) {
            $table->bigIncrements('id_driver');
            $table->bigInteger('number_cc')->notNullable();
            $table->string('first_name', 50)->notNullable();
            $table->string('middle_name', 50);
            $table->string('last_name', 100)->notNullable();
            $table->string('address', 150)->notNullable();
            $table->bigInteger('phone_number')->notNullable();
            $table->integer('id_city')->notNullable();
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
        Schema::dropIfExists('drivers');
    }
}
