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
        Schema::create('candidates', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('source');
            $table->unsignedBigInteger('owner')->nullable()->comment('Id usuario responsable');
            $table->foreign('owner')->references('id')->on('users');
            $table->unsignedBigInteger('created_by')->nullable()->comment('Id usuario que ha creado el candidato');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('candidates');
    }
};
