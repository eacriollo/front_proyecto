<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use NunoMaduro\Collision\Adapters\Phpunit\State;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('equipos', function (Blueprint $table) {
            $table->id();
            $table->string("serie", 55);
           

            // establecer la relacion 1:1 con la tabla productos
            //desde
            $table->bigInteger("producto_id")->unsigned();
            $table->foreign("producto_id")->references("id")->on("productos");
            //hasta

            // establecer la relacion 1:1 con la tabla estados
            //desde
            $table->bigInteger("estado_id")->unsigned();
            $table->foreign("estado_id")->references("id")->on("estados");
            //hasta

            // establecer la relacion 1:N con la tabla personas
            //desde
            $table->bigInteger("persona_id")->unsigned();
            $table->foreign("persona_id")->references("id")->on("personas");
            //hasta

            // establecer la relacion 1:N con la tabla abonados
            //desde
            $table->bigInteger("abonado_id")->unsigned();
            $table->foreign("abonado_id")->references("id")->on("abonados");
            //hasta

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equipos');
    }
};
