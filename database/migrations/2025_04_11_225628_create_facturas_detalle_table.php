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
        Schema::create('facturas_detalle', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->foreignId('factura_id')->constrained('facturas')->onDelete('cascade');
            $table->string('articulo');
            $table->integer('cantidad');
            $table->float('precio_unitario');
            $table->float('subtotal');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('facturas_detalle');
    }
};
