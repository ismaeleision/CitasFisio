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

        Schema::create('servicios', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('servicios');
            $table->string('imagen');
            $table->timestamps();
        });

        /*
        Schema::table('servicios', function (Blueprint $table) {
            $table->string('imagen');
        });
        */
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('servicios');
    }
};
