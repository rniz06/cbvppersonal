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
            $table->string('nombres', 255)->nullable()->after('idpersonal');
            $table->string('apellidos', 255)->nullable()->after('nombres');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('personal', function (Blueprint $table) {
            $table->dropColumn('nombres');
            $table->dropColumn('apellidos');
        });
    }
};
