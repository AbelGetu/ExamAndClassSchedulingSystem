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
        Schema::create('section_allocations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('class_section_allocation_id')->constrained('class_section_allocations');
            $table->foreignId('room_id')->constrained('rooms');
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
        Schema::dropIfExists('section_allocations');
    }
};
