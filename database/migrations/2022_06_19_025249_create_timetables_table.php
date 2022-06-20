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
        Schema::create('timetables', function (Blueprint $table) {
            $table->id();
            $table->foreignId('teacher_allocation_id')->constrained('teacher_allocations');
            $table->foreignId('day_id')->constrained('days');
            $table->foreignId('period_id')->constrained('periods');
            $table->foreignId('room_id')->constrained('rooms');
            $table->foreignId('subject_id')->constrained('subjects');
            $table->integer('day_order');
            $table->integer('period_order');
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
        Schema::dropIfExists('timetables');
    }
};
