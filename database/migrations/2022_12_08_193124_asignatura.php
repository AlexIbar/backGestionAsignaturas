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
        Schema::create('asignaturas', function (Blueprint $table) {
            $table -> id();
            $table -> string('nombre', 100)->nullable(false)->unique();
            $table -> integer('creditos')->nullable(false)->unique();
            $table -> foreignid('id_docente')->constrained('usuarios');
            $table -> boolean('prerrequisito')->nullable(false)->default(true);
            $table -> integer('trabajoAutonomo')->nullable(false);
            $table -> integer('trabajoDirigido')->nullable(false);
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
        Schema::dropIfExists('asignaturas');
    }
};
