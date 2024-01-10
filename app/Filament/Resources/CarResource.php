<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CarResource\Pages;
use App\Models\Car;
use App\Models\Color;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Support\Enums\FontWeight;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class CarResource extends Resource
{
    protected static ?string $model = Car::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Cars';

    protected static ?string $navigationLabel = 'All cars';

    public static function form(Form $form): Form
    {
        return $form

            ->schema([
                Forms\Components\Select::make('car_make')
                    ->label('Car Make Name')
                    ->relationship('model.make', 'name')
                    ->afterStateUpdated(fn (Set $set) => $set('car_model', null))
                    ->searchable()
                    ->dehydrated(false)
                    ->preload()
                    ->required()
                    ->live(),
                Forms\Components\Select::make('car_model')
                    ->label('Car Model Name')
                    ->relationship(
                        name: 'trim.model',
                        titleAttribute: 'name',
                        modifyQueryUsing: fn (Builder $query, Get $get) => $query
                            ->select(['id', 'name'])
                            ->where('car_make_list_id', $get('car_make'))
                    )
                    ->searchable()
                    ->dehydrated(false)
                    ->preload()
                    ->live()
                    ->visible(fn (Get $get) => $get('car_make'))
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
                Tables\Columns\TextColumn::make('model.make.name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('model.name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('trim.class')
                    ->label('Class')
                    ->sortable(),
                Tables\Columns\TextColumn::make('trim.year')
                    ->label('Year')
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\ColorColumn::make('detail.color')
                    ->label('Color')
                    ->copyable()
                    ->copyMessage('Color code copied')
                    ->copyMessageDuration(1500),
                //                    ->tooltip(fn(Car $record): string => "{$record->detail->color}"),
                Tables\Columns\TextColumn::make('detail.price')
                    ->copyable(true)
                    ->copyMessage('Color code copied')
                    ->copyMessageDuration(1500)
                    ->label('Price')
                    ->prefix('$')
                    ->weight(FontWeight::Bold)
                    ->sortable(),
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
            'index' => Pages\ListCars::route('/'),
            'create' => Pages\CreateCar::route('/create'),
            'edit' => Pages\EditCar::route('/{record}/edit'),
        ];
    }
}
