<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CarResource\Api\Transformers\CarTransformer;
use App\Filament\Resources\CarResource\Pages;
use App\Filament\Resources\CarResource\RelationManagers;
use App\Models\Car;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CarResource extends Resource
{
    protected static ?string $model = Car::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Cars Data List';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('car_model_list_id')
                    ->required()
                    ->numeric(),
            ]);
    }

    /**
     * @throws \Exception
     */
    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                Tables\Columns\TextColumn::make('model.make.name')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('model.name')
                    ->searchable()
                    ->sortable(),


                Tables\Columns\TextColumn::make('model.features.class')
                    ->sortable(),

                Tables\Columns\TextColumn::make('model.features.fuel_type')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('model.features.transmission')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('model.features.drive')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('model.features.engine')
                    ->searchable()
                    ->numeric(1)
                    ->sortable(),

                Tables\Columns\ColorColumn::make('details.color'),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('color')
                    ->relationship('details', 'color', fn(Builder $query) => $query->distinct('color'))
                    ->multiple()
                    ->preload(),
            ])
//            ->filtersLayout(Tables\Enums\FiltersLayout::Modal)
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCars::route('/'),
            'create' => Pages\CreateCar::route('/create'),
            'edit' => Pages\EditCar::route('/{record}/edit'),
        ];
    }

    public static function getApiTransformer(): string
    {
        return CarTransformer::class;
    }
}
