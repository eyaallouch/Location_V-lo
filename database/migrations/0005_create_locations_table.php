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
        Schema::create('locations', function (Blueprint $table) {
            $table->bigIncrements('id_location');
            $table->unsignedBigInteger('id_client');
            $table->foreign('id_client')
            ->references('id_client')
            ->on('clients')
            ->onDelete('restrict')
            ->onUpdate('restrict');
            $table->unsignedBigInteger("id_velo");
            $table->foreign('id_velo')
            ->references('id_velo')
            ->on('velos')
            ->onDelete('restrict')
            ->onUpdate('restrict');
            $table->date("datedebut");
            $table->date("datefin");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('locations');
    }
};
