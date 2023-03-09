<?php

namespace App\Admin\Resources\Shop\OrderResource\RelationManagers;

use Ariaieboy\FilamentJalaliDatetime\JalaliDateTimeColumn;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Modules\Shop\Entities\Product;

class ProductsRelationManager extends RelationManager
{
    protected static string $relationship = 'products';

    protected static ?string $recordTitleAttribute = 'name';

    public static function getModelLabel(): string
    {
        return "محصول";
    }

    public static function getPluralModelLabel(): string
    {
        return "محصولات";
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('cover')
                    ->label('عکس شاخص'),
                Tables\Columns\TextColumn::make('name')
                    ->label('نام محصول')
                    ->sortable()
                    ->url(fn (Product $record) => route("shop.product.single", $record))
                    ->searchable(),
                Tables\Columns\TextColumn::make('slug')
                    ->label('url'),
                // Tables\Columns\TextColumn::make('gallery'),
                ImageColumn::make('cover')
                    ->label('کاور'),
                Tables\Columns\TextColumn::make('price')
                    ->label('قیمت (تومان)')
                    ->formatStateUsing(fn (string $state): string => number_format($state)),
                Tables\Columns\TextColumn::make('inventory')
                    ->label('موجودی'),
                JalaliDateTimeColumn::make('updated_at')
                    ->label('آخرین بروزرسانی')
                    ->dateTime(),
            ]);
    }
}
