<?php

namespace App\Providers;

use App\Models\CarMakeList;
use BezhanSalleh\FilamentLanguageSwitch\LanguageSwitch;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Table;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        LanguageSwitch::configureUsing(function (LanguageSwitch $switch) {
            $switch
                ->locales(['en', 'hy', 'ru'])
                ->circular()
                ->flagsOnly();
        });
        Table::configureUsing(function (Table $table): void {
            $table
                ->filtersLayout(FiltersLayout::AboveContentCollapsible)
                ->paginationPageOptions([10, 25, 50, 100]);
        });
        TextColumn::configureUsing(function (TextColumn $column): void {
            $column->toggleable();
        });

    }
}
