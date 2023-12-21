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
        Schema::create('car_models', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(\App\Models\CarMake::class)->constrained();
            $table->foreignIdFor(\App\Models\CarTypes::class)->nullable()->constrained();

            $table->string('name')->index();
            $table->string('slug')->index()->unique();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('car_models');
    }
};
