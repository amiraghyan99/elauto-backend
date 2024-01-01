<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CarModelListResource\Pages;
use App\Filament\Resources\CarModelListResource\RelationManagers;
use App\Models\CarModelList;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CarModelListResource extends Resource
{
    protected static ?string $model = CarModelList::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Cars';

    protected static ?string $navigationParentItem = 'Car Make Lists';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('car_make_list_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('car_type_list_id')
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
                Tables\Columns\TextColumn::make('car_make_list_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('car_type_list_id')
                    ->numeric()
                    ->sortable(),
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
            'index' => Pages\ListCarModelLists::route('/'),
            'create' => Pages\CreateCarModelList::route('/create'),
            'edit' => Pages\EditCarModelList::route('/{record}/edit'),
        ];
    }
}
