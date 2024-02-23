<?php

use App\Models\CarTrim;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(CarTrim::class);

            $table->string('name');
            $table->string('slug');
            
            $table->text('description')->nullable();

            $table->unsignedInteger('year')->nullable();
            $table->timestamp('date_of_first_entry_into_service')->nullable();

            $table->unsignedDecimal('price');
            $table->unsignedTinyInteger('places')->nullable();
            $table->unsignedTinyInteger('doors')->nullable();
            
            $table->unsignedSmallInteger('horsepower')->nullable();
            $table->unsignedSmallInteger('mileage')->nullable();

            // $table->foreignIdFor(Currency::class)->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
