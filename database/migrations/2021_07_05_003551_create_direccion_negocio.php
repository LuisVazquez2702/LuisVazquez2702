<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use phpDocumentor\Reflection\Types\Nullable;

class CreateDireccionNegocio extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('direcciones_negocios', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_negocio')->references('id')->on('negocios');
            $table->string('calle');
            $table->integer('exterior')->nullable();;
            $table->integer('interior')->nullable();
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
        Schema::dropIfExists('direcciones_negocios');
    }
}
