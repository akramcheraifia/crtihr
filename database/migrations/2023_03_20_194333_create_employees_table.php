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
            $table->foreignId('filiere_id')->constrained()->cascadeOnDelete();
            $table->foreignId('corp_id')->constrained()->cascadeOnDelete();
            $table->foreignId('grade_id')->constrained()->cascadeOnDelete();
            $table->string('nom');
            $table->string('prenom');
            $table->string('nom_ar');
            $table->string('prenom_ar');
            $table->char('NIN')->unique();
            $table->char('CNAS')->unique()->nullable();
            $table->date('date_naissance');
            $table->date('date_recrutement');
            $table->string('lieu_naissance');
            $table->string('sexe');
            $table->string('situation_familiale');
            $table->string('type_contrat');
            $table->char('RIB');
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
