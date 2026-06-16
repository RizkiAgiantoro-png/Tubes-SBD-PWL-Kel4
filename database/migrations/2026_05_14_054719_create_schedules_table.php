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
    Schema::create('schedules', function (Blueprint $table) {
        $table->id('schedule_id');

        $table->foreignId('staff_id')
            ->constrained('staff', 'staff_id')
            ->cascadeOnDelete();

        $table->enum('hari', [
            'Monday',
            'Tuesday',
            'Wednesday',
            'Thursday',
            'Friday',
            'Saturday',
            'Sunday'
        ]);

        $table->time('jam_mulai');
        $table->time('jam_selesai');

        $table->enum('status', [
            'available',
            'off'
        ])->default('available');

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedules');
    }
};
