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
    Schema::create('payments', function (Blueprint $table) {
        $table->id('payment_id');

        $table->foreignId('booking_id')
            ->constrained('bookings', 'booking_id')
            ->cascadeOnDelete();

        $table->enum('metode_pembayaran', [
            'cash',
            'transfer',
            'ewallet',
            'credit_card'
        ]);

        $table->dateTime('payment_date')->nullable();

        $table->decimal('total_bayar', 12, 2);

        $table->enum('payment_status', [
            'pending',
            'paid',
            'failed',
            'refunded'
        ])->default('pending');

        $table->timestamps();

        $table->unique('booking_id');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
