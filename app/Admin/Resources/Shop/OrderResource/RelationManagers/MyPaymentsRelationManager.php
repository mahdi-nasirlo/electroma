<?php

namespace App\Admin\Resources\Shop\OrderResource\RelationManagers;

use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables\Columns\BooleanColumn;
use Filament\Tables\Columns\TextColumn;
use Modules\Payment\Entities\Payment;

class MyPaymentsRelationManager extends RelationManager
{
    protected static string $relationship = 'Payments';

    protected static ?string $recordTitleAttribute = 'resnumber';

    public static function getModelLabel(): string
    {
        return "تراکنش";
    }

    public static function getPluralModelLabel(): string
    {
        return "تراکنش ها";
    }


    public static function form(Form $form): Form
    {
        return $form
            ->schema([]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make("resnumber")
                    ->label("کد رهگیری بانک"),
                TextColumn::make("order.price")->label("مبلغ")
                    ->formatStateUsing(fn (string $state): string => number_format($state) . " تومان"),
                TextColumn::make("order.user.name")
                    ->label("کاربر")
                    ->url(fn (Payment $record): string => route("filament.resources.shop/customers.edit", $record->order->user)),
                BooleanColumn::make("status")->label("وضعیت پرداخت")
            ]);
    }
}
