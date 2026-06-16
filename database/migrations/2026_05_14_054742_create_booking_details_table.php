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
    Schema::create('booking_details', function (Blueprint $table) {
        $table->id('booking_detail_id');

        $table->foreignId('booking_id')
            ->constrained('bookings', 'booking_id')
            ->cascadeOnDelete();

        $table->foreignId('service_id')
            ->constrained('services', 'service_id')
            ->cascadeOnDelete();

        $table->integer('qty')->default(1);
        $table->decimal('subtotal', 12, 2);

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booking_details');
    }
};
