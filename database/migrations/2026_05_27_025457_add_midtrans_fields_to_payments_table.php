<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->string('midtrans_order_id')->nullable()->unique()->after('booking_id');
            $table->string('snap_token')->nullable()->after('midtrans_order_id');
            $table->string('snap_redirect_url')->nullable()->after('snap_token');
            $table->string('transaction_status')->nullable()->after('payment_status');
            $table->string('fraud_status')->nullable()->after('transaction_status');
            $table->string('payment_type')->nullable()->after('fraud_status');
        });
    }

    public function down(): void
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->dropColumn([
                'midtrans_order_id',
                'snap_token',
                'snap_redirect_url',
                'transaction_status',
                'fraud_status',
                'payment_type',
            ]);
        });
    }
};