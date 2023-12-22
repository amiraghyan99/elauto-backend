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
        Schema::create('car_feature_lists', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\CarModelList::class)->index();

            $table->string('class')->nullable();
            $table->string('fuel_type')->nullable();
            $table->string('fuel_type_dscr')->nullable();
            $table->string('transmission')->nullable();
            $table->string('drive')->nullable();
            $table->string('eng_dscr')->nullable();

            $table->year('year')->index();
            $table->unsignedDecimal('engine', 4, 1)->nullable()->index();
            $table->unsignedDecimal('time_charge_240', 4, 1)->default(0)->index();

            $table->unsignedTinyInteger('cylinders')->nullable()->index();

            $table->boolean('start_stop')->default(false)->index();
            $table->boolean('mpgdata')->default(false)->index();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('car_features');
    }
};
