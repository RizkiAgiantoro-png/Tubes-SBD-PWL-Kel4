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
    Schema::create('reviews', function (Blueprint $table) {
        $table->id('review_id');

        $table->foreignId('booking_id')
            ->constrained('bookings', 'booking_id')
            ->cascadeOnDelete();

        $table->foreignId('customer_id')
            ->constrained('users')
            ->cascadeOnDelete();

        $table->foreignId('salon_id')
            ->constrained('salons', 'salon_id')
            ->cascadeOnDelete();

        $table->integer('rating');

        $table->text('komentar')->nullable();

        $table->timestamps();

        $table->unique('booking_id');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
