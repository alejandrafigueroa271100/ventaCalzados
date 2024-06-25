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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->nullable();
            $table->integer('estado')->default(1);//1 activo; 0 inactivo
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->foreignId('id_rol');
            $table->foreign('id_rol')->references('id')->on('rol');
            $table->foreignId('id_empleado');
            $table->foreign('id_empleado')->references('id_empleado')->on('empleado');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
