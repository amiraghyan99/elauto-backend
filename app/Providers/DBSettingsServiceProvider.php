<?php

namespace App\Providers;

use App\Models\Car;
use App\Models\CarDetail;
use App\Models\CarTrim;
use App\Models\CarMake;
use App\Models\CarModel;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class DBSettingsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Model::shouldBeStrict(!$this->app->isProduction());
        Model::unguard();

        Schema::defaultStringLength(200);

        Relation::enforceMorphMap([
            'user' => User::class,
            'car_make' => CarMake::class,
            'car_model' => CarModel::class,
            'car_trim' => CarTrim::class,
            'car' => Car::class,
            'car_detail' => CarDetail::class,
            'category' => Category::class,
        ]);
    }
}
