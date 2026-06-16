<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("ALTER TABLE payments MODIFY metode_pembayaran VARCHAR(50) NOT NULL");
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE payments MODIFY metode_pembayaran ENUM('cash','transfer','ewallet','credit_card') NOT NULL");
    }
};