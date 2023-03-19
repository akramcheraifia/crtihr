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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->foreignId('filieres_id')->constrained();
            $table->foreignId('grades_id')->constrained();
            $table->foreignId('corps_id')->constrained();
            $table->string('nom');
            $table->string('prenom');
            $table->string('nom_ar');
            $table->string('prenom_ar');
            $table->char('NIN')->unique();
            $table->char('CNAS')->unique()->nullable();
            $table->timestamp('date_naissance');
            $table->timestamp('date_recrutement');
            $table->string('lieu_naissance');
            $table->boolean('sex');
            $table->string('situation_familiale');
            $table->char('CCP');
            $table->string('email')->unique()->nullable();
            $table->string('phone')->unique()->nullable();
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
