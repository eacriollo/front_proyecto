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
        Schema::create('personas', function (Blueprint $table) {
            $table->id(); //id, ai, bigInt, unsigned
            $table->string("nombre",60);
            $table->string("ci",13)->nullable();

           /* // establecer la relacion 1:1 con la tabla usuarios
            //desde
            $table->bigInteger("user_id")->unsigned();
            $table->foreign("user_id")->references("id")->on("users");
            //hasta

            */
                
            $table->timestamps(); // cuando se actualiza y cuando se crea 
            $table->softDeletes(); // cuando se elimina los registros
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personas');
    }
};
