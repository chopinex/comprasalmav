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
        Schema::create('compras', function (Blueprint $table) {
            $table->id();
            $table->string('pertenencia');
            $table->string('tipo_documento');
            $table->string('numero_documento');
            $table->dateTime('fecha_documento');
            $table->string('proveedor');
            $table->string('area');
            $table->string('servicio');
            $table->string('proyecto');
            $table->enum('moneda',array('soles','dólares'));
            $table->float('tipo_cambio');
            $table->float('total');
            $table->float('pagado');
            $table->dateTime('fecha_pago');
            $table->timestamps();
            $table->string('detalle_pago');
            $table->string('comentario');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('compras');
    }
};
