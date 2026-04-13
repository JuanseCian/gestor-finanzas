<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaccionesTable extends Migration
{
    public function up()
    {
        Schema::create('transacciones', function (Blueprint $table) {
            $table->id();

            $table->foreignId('usuario_id')
                  ->constrained('users')
                  ->onDelete('cascade');

            $table->enum('tipo', ['ingreso', 'gasto']);

            $table->decimal('monto', 10, 2);

            $table->text('descripcion')->nullable();

            $table->foreignId('categoria_id')
                  ->nullable()
                  ->constrained('categorias')
                  ->nullOnDelete();

            $table->foreignId('cuenta_id')
                  ->nullable()
                  ->constrained('cuentas')
                  ->nullOnDelete();

            $table->date('fecha');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('transacciones');
    }
}