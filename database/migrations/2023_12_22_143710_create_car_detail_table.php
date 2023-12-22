<?php

use App\Models\Car;
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
        Schema::create('car_details', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Car::class)->constrained()->cascadeOnDelete();
            $table->string('color')->default('#FFFFFF');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('car_detail_lists');
    }
};
