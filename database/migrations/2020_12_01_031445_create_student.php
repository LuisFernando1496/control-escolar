<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudent extends Migration
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
            $table->double('behaviour'); // range [0 - 10]
            $table->boolean('banned'); // 0 = no 1 = si
            $table->boolean('end'); // 0 = no 1 = si
            $table->timestamp('banned_time')->nullable();
            $table->date('period')->nullable(); // periodo en el cuel el alumono es incrito por primera vez
            $table->integer('strikes')->unsigned();
            $table->boolean('paid'); // 0 = no 1 = si
            $table->text('address');
            $table->foreignId('tutor_id')->references('id')->on('users')->cascadeOnDelete();
            $table->foreignId('current_grade_id')->references('id')->on('grades')->cascadeOnDelete();
            $table->foreignId('current_group_id')->references('id')->on('groups')->cascadeOnDelete();
            $table->foreignId('blood_id')->references('id')->on('bloods')->cascadeOnDelete();
            $table->foreignId('user_id')->references('id')->on('users')->cascadeOnDelete();
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
        Schema::dropIfExists('students');
    }
}
