<?php

namespace App\Filament\Resources\ProductResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class VariantsRelationManager extends RelationManager
{
    protected static string $relationship = 'variants';

    protected static ?string $title = 'Sizes & Stock';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('size')
                    ->options([
                        'S' => 'S',
                        'M' => 'M',
                        'L' => 'L',
                        'XL' => 'XL',
                        'XXL' => 'XXL',
                    ])
                    ->required(),
                Forms\Components\TextInput::make('color')
                    ->maxLength(255)
                    ->placeholder('optional, e.g. Black'),
                Forms\Components\TextInput::make('stock')
                    ->numeric()
                    ->required()
                    ->default(0),
                Forms\Components\TextInput::make('sku')
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('size')
            ->columns([
                Tables\Columns\TextColumn::make('size'),
                Tables\Columns\TextColumn::make('color')
                    ->placeholder('N/A'),
                Tables\Columns\TextColumn::make('stock')
                    ->badge()
                    ->color(fn (int $state) => $state > 0 ? 'success' : 'danger'),
                Tables\Columns\TextColumn::make('sku'),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ]);
    }
}
