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
        Schema::create('search_models', function (Blueprint $table) {
            $table->id();
            $table->text('content'); // Assurez-vous d'adapter ce champ selon vos besoins$table->text('html_content')->nullable(); // Ajouter la colonne html_content
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('search_models');
    }
};
