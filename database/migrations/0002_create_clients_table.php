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
        Schema::create('clients', function (Blueprint $table) {
            $table->bigIncrements('id_client');
            $table->bigInteger("cin")->unique();
            //$table->string("nom", 200);
            $table->integer("age");
          //  $table->string("email", 255)->unique();
            $table->bigInteger("number");
            $table->unsignedBigInteger("id_user");
            $table->foreign('id_user')
                ->references('id_user')
                ->on('users')
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
        Schema::dropIfExists('clients');
    }
};
