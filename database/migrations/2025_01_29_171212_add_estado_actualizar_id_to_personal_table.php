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
        Schema::table('personal', function (Blueprint $table) {
            $table->unsignedBigInteger('estado_actualizar_id')->nullable();
            $table->foreign('estado_actualizar_id')->references('idpersonal_estado_actualizar')->on('personal_estado_actualizar')->onUpdate('cascade')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('personal', function (Blueprint $table) {
            $table->dropColumn('estado_actualizar_id');
        });
    }
};
