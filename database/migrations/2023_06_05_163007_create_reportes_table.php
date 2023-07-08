<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reportes', function (Blueprint $table) {
            $table->id();
            $table->string('tour');
            $table->string('nombre');
            $table->string('numero');
            $table->date('llegada')->nullable();
            $table->date('salida')->nullable(); // Agregada columna 'salida' con valores nulos
            $table->string('email');
            $table->date('fechaInicio')->nullable(); // Agregada columna 'fechaInicio' con valores nulos
            $table->integer('numPaxs');
            $table->integer('precio');
            $table->integer('adelanto');
            $table->text('detalles')->nullable(); // Agregada columna 'detalles' con valores nulos
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
        Schema::dropIfExists('reportes');
    }
};
