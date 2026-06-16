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
    Schema::create('salon_images', function (Blueprint $table) {
        $table->id('image_id');

        $table->foreignId('salon_id')
            ->constrained('salons', 'salon_id')
            ->cascadeOnDelete();

        $table->string('image_path');

        $table->enum('image_type', [
            'gallery',
            'banner',
            'logo',
            'interior',
            'treatment'
        ])->default('gallery');

        $table->boolean('is_thumbnail')
            ->default(false);

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('salon_images');
    }
};
