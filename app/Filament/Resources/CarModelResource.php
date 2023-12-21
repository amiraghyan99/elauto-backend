<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CarModelResource\Pages;
use App\Models\CarModel;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class CarModelResource extends Resource
{
    protected static ?string $model = CarModel::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Cars Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('car_make_id')
                    ->relationship('carMake', 'name')
                    ->required(),
                Forms\Components\TextInput::make('car_types_id')
                    ->numeric(),
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(200),
                Forms\Components\TextInput::make('slug')
                    ->required()
                    ->maxLength(200),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('carMake.name')
                    ->numeric()
                    ->searchable()
                    ->sortable(),
                //                Tables\Columns\TextColumn::make('car_types_id')
                //                    ->numeric()
                //                    ->sortable(),
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('slug')
                    ->searchable(),
            ])
            ->filters([
                //
            ])
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCarModels::route('/'),
            'create' => Pages\CreateCarModel::route('/create'),
            'edit' => Pages\EditCarModel::route('/{record}/edit'),
        ];
    }
}
