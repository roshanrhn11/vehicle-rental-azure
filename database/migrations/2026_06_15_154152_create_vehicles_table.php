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
    Schema::create('vehicles', function (Blueprint $table) {
        $table->id();
        $table->string('vehicle_name');
        $table->string('vehicle_type');
        $table->string('brand')->nullable();
        $table->string('model')->nullable();
        $table->string('location');
        $table->decimal('price_per_day', 10, 2);
        $table->text('description')->nullable();
        $table->string('image_path')->nullable();
        $table->string('status')->default('available');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
