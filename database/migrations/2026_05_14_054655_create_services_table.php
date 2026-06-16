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
    Schema::create('services', function (Blueprint $table) {
        $table->id('service_id');

        $table->foreignId('salon_id')
            ->constrained('salons', 'salon_id')
            ->cascadeOnDelete();

        $table->foreignId('category_id')
            ->constrained('categories', 'category_id')
            ->restrictOnDelete();

        $table->string('nama_service');

        $table->integer('durasi');

        $table->decimal('harga', 12, 2);

        $table->text('deskripsi')
            ->nullable();

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
