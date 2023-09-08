<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehiculosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehiculos', function (Blueprint $table) {
            $table->bigIncrements('id_vehicle');
            $table->string('plate', 10)->notNullable();
            $table->integer('id_brand')->notNullable();
            $table->integer('id_type')->notNullable();
            $table->string('color')->notNullable();
            $table->integer('id_driver')->notNullable();
            $table->integer('id_owner')->notNullable();
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
        Schema::dropIfExists('vehiculos');
    }
}
