<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDireccionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('direccion', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("id_cliente")->references('id')->on('clientes')->nullable();
            $table->string("calle");
            $table->integer("exterior")->nullable();
            $table->integer("interior")->nullable();
            $table->string("colonia");
            $table->integer("codigoPostal");
            $table->string("localidad");
            $table->string("estado");
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
        Schema::dropIfExists('direccion');
    }
}
