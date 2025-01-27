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
        Schema::create('personal_contactos', function (Blueprint $table) {
            $table->id('id_personal_contacto');
            $table->unsignedBigInteger('personal_id');
            $table->unsignedBigInteger('tipo_contacto_id');
            $table->string('contacto', 50);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personal_contactos');
    }
};
