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
        Schema::create('personal_contactos_emergencias', function (Blueprint $table) {
            $table->id('id_contacto_emergencia');
            $table->integer('personal_id')->nullable(); // Tipo Integer debido a que asi es el tipo de campo en la tabla personal
            $table->unsignedBigInteger('tipo_contacto_id')->nullable();
            $table->unsignedBigInteger('parentesco_id')->nullable();
            $table->unsignedBigInteger('ciudad_id')->nullable();
            $table->string('nombre_completo', 100);
            $table->string('direccion', 100)->nullable();
            $table->string('contacto', 50);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('personal_id')->references('idpersonal')->on('personal')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('tipo_contacto_id')->references('id_tipo_contacto')->on('personal_tipo_contactos')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('parentesco_id')->references('id_parentesco')->on('personal_parentescos')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personal_contactos_emergencias');
    }
};
