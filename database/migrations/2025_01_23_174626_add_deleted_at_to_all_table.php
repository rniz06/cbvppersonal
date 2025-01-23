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
        Schema::table('users', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('paises', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('personal', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('personal_categorias', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('personal_estados', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('personal_reportes', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('personal_sexo', function (Blueprint $table) {
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('deleted_at');
        });

        Schema::table('paises', function (Blueprint $table) {
            $table->dropColumn('deleted_at');
        });

        Schema::table('personal', function (Blueprint $table) {
            $table->dropColumn('deleted_at');
        });

        Schema::table('personal_categorias', function (Blueprint $table) {
            $table->dropColumn('deleted_at');
        });

        Schema::table('personal_estados', function (Blueprint $table) {
            $table->dropColumn('deleted_at');
        });

        Schema::table('personal_reportes', function (Blueprint $table) {
            $table->dropColumn('deleted_at');
        });

        Schema::table('personal_sexo', function (Blueprint $table) {
            $table->dropColumn('deleted_at');
        });
    }
};
