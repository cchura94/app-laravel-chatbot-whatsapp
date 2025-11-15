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
        Schema::create('mensajes', function (Blueprint $table) {
            $table->id();
            $table->text("mensaje")->nullable();
            $table->string("generado_por")->default("system")->nullable();
            $table->boolean("from_me")->default(false);
            $table->bigInteger("contacto_id")->unsigned();
            $table->foreign("contacto_id")->references("id")->on("contactos");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mensajes');
    }
};
