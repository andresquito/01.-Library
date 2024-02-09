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
        Schema::create('ventas', function (Blueprint $table) {
            $table->id();
            $table->String('cedula', 10);
            $table->String('identificador', 10);
            $table->integer('cantidad')->nullable();
            $table->date('fecha');
            $table->decimal('precio',10,2);
            $table->timestamps();
            $table->foreign('cedula')->references('cedula')->on('clients');
            $table->foreign('identificador')->references('identificador')->on('obras');
            //create index cedula_index on clients(cedula);
            //create index identificador_index on obras(identificador);
            //hay que crear los index para realizar sus claves foraneas respectivas
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ventas');
    }
};
