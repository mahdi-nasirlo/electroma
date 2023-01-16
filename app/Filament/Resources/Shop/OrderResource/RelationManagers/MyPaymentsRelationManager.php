<?php

namespace App\Filament\Resources\Shop\OrderResource\RelationManagers;

use App\Models\MyPayment;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\BooleanColumn;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

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
                    ->url(fn (MyPayment $record): string => route("filament.resources.shop/customers.edit", $record->order->user)),
                BooleanColumn::make("status")->label("وضعیت پرداخت")
            ]);
    }
}
