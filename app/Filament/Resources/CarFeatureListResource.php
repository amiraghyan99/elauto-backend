<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CarFeatureListResource\Pages;
use App\Models\CarFeatureList;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class CarFeatureListResource extends Resource
{
    protected static ?string $model = CarFeatureList::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Cars Data List';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('car_model_list_id')
                    ->label('Model ID')
                    ->required()
                    ->numeric(),
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
                    ->required(),
                Forms\Components\TextInput::make('engine')
                    ->numeric(),
                Forms\Components\TextInput::make('time_charge_240')
                    ->required()
                    ->numeric()
                    ->default(0.0),
                Forms\Components\Toggle::make('cylinders'),
                Forms\Components\Toggle::make('start_stop')
                    ->required(),
                Forms\Components\Toggle::make('mpgdata')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('ID')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('make.name')
                    ->label('Make Name')
                    ->sortable(),
                Tables\Columns\TextColumn::make('model.name')
                    ->label('Model Name')
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
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('engine')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('time_charge_240')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\IconColumn::make('cylinders')
                    ->boolean(),
                Tables\Columns\IconColumn::make('start_stop')
                    ->boolean(),
                Tables\Columns\IconColumn::make('mpgdata')
                    ->boolean(),
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
            'index' => Pages\ListCarFeatureLists::route('/'),
            'create' => Pages\CreateCarFeatureList::route('/create'),
            'edit' => Pages\EditCarFeatureList::route('/{record}/edit'),
        ];
    }
}
