<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('citas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('fecha');
            $table->integer('hora');
            $table->text('observaciones')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('servicio_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('servicio_id')->references('id')->on('servicios');
            //No puede haber dos citas el mismo día a la misma hora
            $table->unique(["fecha", "hora"], 'mismodia_unique');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('citas');
    }
};
