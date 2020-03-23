<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSamplesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('samples', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');


            $table->string('name');
            $table->integer('amount')->nullable();
            $table->text('structure');
            $table->text('note')->nullable();
            $table->timestamps();


            $table->unsignedBigInteger('spectrometer_id');
            $table->unsignedBigInteger('lab_id')->nullable();
            $table->unsignedBigInteger('solvent_id');
            $table->unsignedBigInteger('grant_id')->nullable();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('spectrometer_id')->references('id')->on('spectrometers');
            $table->foreign('lab_id')->references('id')->on('labs')->onDelete('cascade');
            $table->foreign('solvent_id')->references('id')->on('solvents')->onDelete('cascade');
            $table->foreign('grant_id')->references('id')->on('grants')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('samples');
    }
}
