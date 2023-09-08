<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOwnersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('owners', function (Blueprint $table) {
            $table->bigIncrements('id_owner');
            $table->bigInteger('number_cc')->notNullable();
            $table->string('first_name', 50)->notNullable();
            $table->string('middle_name', 50)->nullable();
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
        Schema::dropIfExists('owners');
    }
}
