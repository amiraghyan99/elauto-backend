<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CarResource\Api\Transformers\CarTransformer;
use App\Filament\Resources\CarResource\Pages;
use App\Models\Car;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class CarResource extends Resource
{
    protected static ?string $model = Car::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Cars Data List';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Make and Mode')
                    ->schema([
                        Forms\Components\Select::make('car_make_list_id')
                            ->label('Car Make')
                            ->relationship(name: 'make', titleAttribute: 'name')
                            ->searchable()
                            ->afterStateUpdated(function (Set $set) {
                                $set('car_model_list_id', null);
                            })
                            ->live()
                            ->preload(),

                        Forms\Components\Select::make('car_model_list_id')
                            ->label('Car Model')
                            ->visible(fn(Get $get) => filled($get('car_make_list_id')))
                            ->relationship(
                                name: 'model',
                                titleAttribute: 'name',
                                modifyQueryUsing: fn(Builder $query, Get $get): Builder => $query->where('car_make_list_id', $get('car_make_list_id'))
                            )
                            ->searchable()
                            ->preload()
                            ->required(),
                    ])->columns(),
                Forms\Components\Section::make('Color')
                    ->schema([
                        Forms\Components\ColorPicker::make('color')
                            ->label('Color')
                            ->hex()
                            ->hexColor()
                            ->required(),
                    ])->columns(6),
                Forms\Components\Section::make('Price')
                    ->schema([
                        Forms\Components\TextInput::make('price')
                            ->label('Price')
                            ->numeric()
                            ->inputMode('decimal')
                            ->prefix('$')
                            ->nullable(),
                    ])->columns(6),
                Forms\Components\Section::make('Images')
                    ->schema([
                        Forms\Components\SpatieMediaLibraryFileUpload::make('images')
                            ->required()
                            ->label('Images')
                            ->multiple()
                    ]),

            ]);
    }

    /**
     * @throws \Exception
     */
    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                Tables\Columns\TextColumn::make('make.name')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('model.name')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('features.class')
                    ->sortable(),

                Tables\Columns\TextColumn::make('features.fuel_type')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('features.transmission')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('features.drive')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('features.engine')
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

    //    public static function getApiTransformer(): string
    //    {
    //        return CarTransformer::class;
    //    }
}
