<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    /*
    create table producto(
    id_producto int auto_increment primary key,
    descripcion varchar(30),
    precio float not null,
    id_categoria int not null,
    foreign key(id_categoria) references categoria(id_categoria));
    */
    public function up(): void
    {
        Schema::create('producto', function (Blueprint $table) {
            $table->id('id_producto');
            $table->string('nombre');
            $table->string('tamanio');
            $table->float('precio');
            $table->integer('estado')->default(0);
            $table->foreignId('id_categoria');
            $table->foreign('id_categoria')->references('id_categoria')->on('categoria');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('producto');
    }
};
