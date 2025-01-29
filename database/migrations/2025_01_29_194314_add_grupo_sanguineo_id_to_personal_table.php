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
            $table->unsignedBigInteger('grupo_sanguineo_id')->nullable();
            $table->foreign('grupo_sanguineo_id')->references('idpersonal_grupo_sanguineo')->on('personal_grupo_sanguineo')->onUpdate('cascade')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('personal', function (Blueprint $table) {
            $table->dropColumn('grupo_sanguineo_id');
        });
    }
};
