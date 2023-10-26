<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('profiles', function (Blueprint $table) {
            $table->boolean('is_active')->default(true); // Hier definiëren we de nieuwe kolom 'is_active'
        });
    }

    public function down()
    {
        Schema::table('profiles', function (Blueprint $table) {
            $table->dropColumn('is_active'); // Hier verwijderen we de kolom 'is_active' in de rollback-migratie
        });
    }
};
