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
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('designation',100)->unique();
            $table->string('marque');
            $table->string('reference');
            $table->string('qtestock');
            $table->string('prix');
            $table->string('imageart');
            $table->unsignedBigInteger('scategorieID');
            $table->foreign('scategorieID')
                    ->references('id')
                    ->on('scategories')
                    ->onDelete('restrict')
                    ->onUpdate('restrict');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
