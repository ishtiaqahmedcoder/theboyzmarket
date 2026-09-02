<?php

namespace App\Filament\Resources\OrderResource\RelationManagers;

use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class ItemsRelationManager extends RelationManager
{
    protected static string $relationship = 'items';

    protected static ?string $title = 'Order Items';

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('product_name')
            ->columns([
                Tables\Columns\TextColumn::make('product_name')
                    ->label('Product'),
                Tables\Columns\TextColumn::make('size'),
                Tables\Columns\TextColumn::make('color')
                    ->placeholder('N/A'),
                Tables\Columns\TextColumn::make('price')
                    ->money('PKR'),
                Tables\Columns\TextColumn::make('quantity'),
                Tables\Columns\TextColumn::make('subtotal')
                    ->money('PKR'),
            ])
            ->headerActions([])
            ->actions([])
            ->bulkActions([]);
    }
}
