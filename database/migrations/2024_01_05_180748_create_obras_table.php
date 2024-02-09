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
        Schema::create('obras', function (Blueprint $table) {
            $table->id();
            $table->string('identificador',10);
            $table->string('tipo',75);
            $table->string('titulo',75);
            $table->string('autor',75);
            $table->string('genero',75)->nullable();
            $table->string('editorial',75)->nullable();
            $table->string('frecuencia',15)->nullable();
            $table->string('tipo_pintura',25)->nullable();
            $table->date('año_creacion');
            $table->date('año_recepcion');
            $table->string('antiguedad')->nullable();
            //no admite signos
            $table->integer('stock')->unsigned();
            $table->decimal('precio',10,2);
            $table->decimal('total',10,2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('obras');
    }
};
