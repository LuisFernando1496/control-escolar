<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ScheduleStudent extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("schedule_student", function (Blueprint $table) {
            $table->id();
            $table
            ->foreignId("schedule_id")
            ->references("id")
            ->on("schedules")
            ->onDelete("cascade");
            $table
            ->foreignId("student_id")
            ->references("id")
            ->on("students")
            ->onDelete("cascade");
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
        //
    }
}
