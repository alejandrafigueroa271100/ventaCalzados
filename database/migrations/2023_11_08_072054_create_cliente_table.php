<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        /*
        create table cliente(
        id_cliente int AUTO_INCREMENT PRIMARY KEY,
        nombre varchar(30),
        apellidos varchar(30),
        empresa varchar(50),
        telefono varchar(10),
        direccion varchar(50));
        */
        Schema::create('cliente', function (Blueprint $table) {
            $table->id('id_cliente');
            $table->string('nombre');
            $table->string('apellidos');
            // $table->string('empresa')->nullable();
            $table->string('telefono')->nullable();
            $table->string('direccion')->nullable();
            $table->integer('estado')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cliente');
    }
};
