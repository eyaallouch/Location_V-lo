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
        Schema::create('velos', function (Blueprint $table) {
            $table->bigIncrements('id_velo');
            $table->string("nom_velo",200);
            $table->integer("year");
            $table->float("price_day");
            $table->boolean("disponibilité")->default(1);
            $table->string("image",200);
            $table->unsignedBigInteger("id_model");
            $table->foreign('id_model')
                ->references('id_model')
                ->on('modeles')
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
        Schema::dropIfExists('velos');
    }
};
