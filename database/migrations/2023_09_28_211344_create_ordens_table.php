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
        Schema::create('ordens', function (Blueprint $table) {
            $table->id();
            $table->dateTime("fecha");
            $table->string("acta", 10);
            $table->string("ticket", 15)->nullable();
            $table->string("manga", 10)->nullable();
            $table->string("pdf", 150)->nullable();
            $table->text("observacion")->nullable();

             // establecer la relacion 1:N con la tabla abonados
            //desde
            $table->bigInteger("abonado_id")->unsigned();
            $table->foreign("abonado_id")->references("id")->on("abonados");
            //hasta

             // establecer la relacion 1:N con la tabla usuarios
            //desde
            $table->bigInteger("user_id")->unsigned();
            $table->foreign("user_id")->references("id")->on("users");
            //hasta

             // establecer la relacion 1:N con la tabla personas
            //desde
            $table->bigInteger("persona_id")->unsigned();
            $table->foreign("persona_id")->references("id")->on("personas");
            //hasta

            // establecer la relacion 1:N con la tabla precios
            //desde
            $table->bigInteger("precio_id")->unsigned();
            $table->foreign("precio_id")->references("id")->on("precios");
            //hasta

            // establecer la relacion 1:N con la tabla actividads
            //desde
            $table->bigInteger("actividad_id")->unsigned();
            $table->foreign("actividad_id")->references("id")->on("actividads");
            //hasta

            // establecer la relacion 1:N con la tabla ciudads
            //desde
            $table->bigInteger("ciudad_id")->unsigned();
            $table->foreign("ciudad_id")->references("id")->on("ciudads");
            //hasta

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ordens');
    }
};
