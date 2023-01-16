<?php

namespace App\Filament\Resources\Shop\CourceResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OrdersRelationManager extends RelationManager
{
    protected static string $relationship = 'orders';

    protected static ?string $recordTitleAttribute = 'user_id';

    public static function getModelLabel(): string
    {
        return "سفارش";
    }

    public static function getPluralModelLabel(): string
    {
        return "سفارشات";
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make("status")
                    ->label("وضعیت")
                    ->options([
                        'unpaid' => 'درحال پرداخت',
                        'paid' => 'پرداخت موفق',
                        'preparation' => 'آماده سازی',
                        "posted" => "ارسال شده",
                        "received" => "دریافت شده"
                    ]),
                TextInput::make("tracking_serial")->label("کد پیگیری پست"),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user_id')
                    ->label("ID کاربر"),
                TextColumn::make("tracking_serial")->label("کد پیگیری پست"),
                TextColumn::make("user.name")->label("کاربر"),
                TextColumn::make("price")
                    ->label("مبلغ")
                    ->formatStateUsing(fn (string $state): string => number_format($state) . " تومان"),
                TextColumn::make("status")
                    ->label("وضعیت")
                    ->enum(
                        [
                            'unpaid' => 'درحال پرداخت',
                            'paid' => 'پرداخت موفق',
                            'preparation' => 'آماده سازی',
                            "posted" => "ارسال شده",
                            "received" => "دریافت شده"
                        ]
                    ),
                TextColumn::make("user.city")
                    ->label("شهر"),
                TextColumn::make("user.state")
                    ->label("استان"),
                TextColumn::make("user.address")
                    ->label("آدرس")
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ]);
    }
}
