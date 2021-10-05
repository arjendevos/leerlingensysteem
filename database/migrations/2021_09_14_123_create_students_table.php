<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('street');
            $table->string('postcode');
            $table->string('city');
            $table->string('country');
            $table->unsignedBigInteger('education_id');
            $table->unsignedBigInteger('class_id');

            $table->timestamps();

            $table->foreign('education_id')
            ->references('id')->on('education')
            ->nullable()
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->foreign('class_id')
            ->references('id')->on('classes')
            ->nullable()
            ->onDelete('cascade')
            ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students');
    }
}
