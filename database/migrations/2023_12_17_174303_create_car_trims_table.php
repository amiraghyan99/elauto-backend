<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('car_trims', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\CarModel::class)->index();

            $table->string('name');
            $table->string('slug');

            $table->text('description')->nullable();

            $table->unsignedInteger('year')->nullable();
            $table->unsignedSmallInteger('horsepower')->nullable();
            $table->unsignedSmallInteger('mileage')->nullable();
            
            $table->string('fuel')->nullable();
            $table->unsignedInteger('msrp')->nullable();
            $table->unsignedInteger('invoice')->nullable();

            $table->decimal('fuel_tank_capacity',4,4)->nullable();
            $table->unsignedInteger('combined_mpg')->nullable();
            $table->unsignedInteger('epa_city_mpg')->nullable();
            $table->unsignedInteger('epa_highway_mpg')->nullable();
            $table->unsignedInteger('range_city')->nullable();
            $table->unsignedInteger('range_highway')->nullable();
            $table->unsignedInteger('battery_capacity_electric')->nullable();
            $table->unsignedInteger('epa_time_to_charge_hr_240v_electric')->nullable();
            $table->unsignedInteger('epa_kwh_100_mi_electric')->nullable();
            $table->unsignedInteger('range_electric')->nullable();
            $table->unsignedInteger('epa_highway_mpg_electric')->nullable();
            $table->unsignedInteger('epa_city_mpg_electric')->nullable();
            $table->unsignedInteger('epa_combined_mpg_electric')->nullable();


            // $table->string('class')->nullable();
            // $table->string('fuel_type')->nullable();
            // $table->string('fuel_type_dscr')->nullable();
            // $table->string('transmission_type')->nullable();
            // $table->string('transmission')->nullable();
            // $table->string('drive')->nullable();
            // $table->string('eng_dscr')->nullable();

            // $table->year('year')->index();
            // $table->unsignedDecimal('engine', 4, 1)->nullable()->index();
            // $table->unsignedDecimal('time_charge_240', 4, 1)->default(0)->index();

            // $table->unsignedTinyInteger('cylinders')->nullable()->index();

            // $table->boolean('start_stop')->default(false)->index();
            // $table->boolean('mpgdata')->default(false)->index();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('car_trims');
    }
};
