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
    Schema::create('salons', function (Blueprint $table) {
        $table->id('salon_id');

        $table->foreignId('owner_id')
            ->constrained('users')
            ->cascadeOnDelete();

        $table->foreignId('kota_id')
            ->constrained('kotas', 'kota_id')
            ->restrictOnDelete();

        $table->string('nama_salon');
        $table->text('alamat');

        $table->text('deskripsi')->nullable();

        $table->decimal('rating', 2, 1)
            ->default(0);

        $table->time('jam_buka');
        $table->time('jam_tutup');

        $table->enum('status', [
            'active',
            'inactive'
        ])->default('active');

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('salons');
    }
};
