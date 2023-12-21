<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CarFeaturesResource\Pages;
use App\Filament\Resources\CarFeaturesResource\RelationManagers\CarModelRelationManager;
use App\Models\CarFeatures;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class CarFeaturesResource extends Resource
{
    protected static ?string $model = CarFeatures::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('car_model_id')
                    ->relationship('carModel', 'name')
                    ->required(),
                Forms\Components\TextInput::make('class')
                    ->maxLength(200),
                Forms\Components\TextInput::make('fuel_type')
                    ->maxLength(200),
                Forms\Components\TextInput::make('fuel_type_dscr')
                    ->maxLength(200),
                Forms\Components\TextInput::make('transmission')
                    ->maxLength(200),
                Forms\Components\TextInput::make('drive')
                    ->maxLength(200),
                Forms\Components\TextInput::make('eng_dscr')
                    ->maxLength(200),
                Forms\Components\DatePicker::make('year')
                    ->native(false)
                    ->displayFormat('Y')
                    ->format('Y')
                    ->required(),
                Forms\Components\TextInput::make('engine')
                    ->numeric()
                    ->required(),
                Forms\Components\TextInput::make('time_charge_240')
                    ->numeric('decimal')
                    ->default(0.0)
                    ->required(),
                Forms\Components\TextInput::make('cylinders')
                    ->integer()
                    ->required(),
                Forms\Components\Toggle::make('start_stop')
                    ->required(),
                Forms\Components\TextInput::make('mpgdata')
                    ->integer()
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('carModel.name')
                    ->label('Model Name')
                    ->sortable(),
                Tables\Columns\TextColumn::make('carModel.slug')
                    ->label('Model Slug')
                    ->sortable(),
                Tables\Columns\TextColumn::make('class')
                    ->searchable(),
                Tables\Columns\TextColumn::make('fuel_type')
                    ->searchable(),
                Tables\Columns\TextColumn::make('fuel_type_dscr')
                    ->searchable(),
                Tables\Columns\TextColumn::make('transmission')
                    ->searchable(),
                Tables\Columns\TextColumn::make('drive')
                    ->searchable(),
                Tables\Columns\TextColumn::make('eng_dscr')
                    ->searchable(),
                Tables\Columns\TextColumn::make('year')
                    ->date('Y')
                    ->sortable(),
                Tables\Columns\TextColumn::make('engine')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('time_charge_240')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('cylinders')
                    ->numeric(),

                Tables\Columns\IconColumn::make('start_stop')
                    ->boolean(),
                Tables\Columns\IconColumn::make('mpgdata')
                    ->boolean(),
            ])
            ->filters([
                //
            ])
            ->configure()
            ->actions([
                Tables\Actions\EditAction::make(),
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
            CarModelRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCarFeatures::route('/'),
            'create' => Pages\CreateCarFeatures::route('/create'),
            'edit' => Pages\EditCarFeatures::route('/{record}/edit'),
        ];
    }
}
