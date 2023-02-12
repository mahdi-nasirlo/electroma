<?php

namespace App\Admin\Resources\Shop;

use App\Admin\Resources\Shop\DiscountItemResource\Pages;
use App\Admin\Resources\Shop\DiscountItemResource\RelationManagers;
use App\Admin\Resources\Shop\DiscountItemResource\RelationManagers\ProductsRelationManager;
use Ariaieboy\FilamentJalaliDatetime\JalaliDateTimeColumn;
use Ariaieboy\FilamentJalaliDatetimepicker\Forms\Components\JalaliDateTimePicker;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Modules\Payment\Entities\DiscountItem;

class DiscountItemResource extends Resource
{
    protected static ?string $model = DiscountItem::class;

    protected static ?string $recordTitleAttribute = 'percent';

    protected static ?string $navigationGroup = 'تخفیف %';

    protected static ?string $navigationIcon = 'heroicon-o-shopping-cart';


    public static function getModelLabel(): string
    {
        return "تخفیف";
    }

    public static function getPluralModelLabel(): string
    {
        return "تخفیفات موردی";
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make()
                    ->schema([
                        TextInput::make("percent")
                            ->required()
                            ->label("درصد")
                            ->numeric()
                            ->maxValue(100)
                            ->minValue(0)
                            ->suffix('%')
                            ->default(0),
                        JalaliDateTimePicker::make("expired_at")
                            ->required()
                            ->label("تاریخ انقضا")
                    ])
                    ->columns([
                        'sm' => 2,
                    ])
                    ->columnSpan([
                        'sm' => 2,
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make("percent")
                    ->label("درصد")
                    ->sortable(),
                JalaliDateTimeColumn::make('expired_at')
                    ->dateTime()
                    ->label('تاریخ انقضا')
                    ->sortable()
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            ProductsRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDiscountItems::route('/'),
            'create' => Pages\CreateDiscountItem::route('/create'),
            'edit' => Pages\EditDiscountItem::route('/{record}/edit'),
        ];
    }
}
