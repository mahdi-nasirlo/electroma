<?php

namespace App\Admin\Widgets;

use BezhanSalleh\FilamentShield\Traits\HasWidgetShield;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Actions\Action;
use Filament\Tables\Filters\SelectFilter;
use Modules\Payment\Entities\Order;

class LatestOrders extends BaseWidget
{
    use HasWidgetShield;

    protected int | string | array $columnSpan = 'full';

    protected static ?int $sort = 3;

    protected static ?string $heading = "اخرین سفارشات با وضعیت";

    protected function getTableActions(): array
    {
        return [
            Tables\Actions\EditAction::make()->label("تغییر وضعیت"),
            Action::make('view')
                ->label("جزئیات")
                ->color('info')
                ->icon('heroicon-o-eye'),
            // ->url(fn (Order $record): string => route('filament.resources.shop/orders.view', $record)),
            Action::make('address')
                ->label("اطلاعات پست")
                ->color('success')
            // ->url(fn (Order $record): string => route("filament.resources.shop/customers.edit", $record->user))
        ];
    }

    protected function getTableFilters(): array
    {
        return [
            SelectFilter::make('status')->label("وضعیت")
                ->options([
                    'unpaid' => 'درحال پرداخت',
                    'paid' => 'پرداخت موفق',
                    'preparation' => 'آماده سازی',
                    "posted" => "ارسال شده",
                    "received" => "دریافت شده"
                ])
        ];
    }

    protected function getTableQuery(): Builder
    {
        return Order::query()->where("status", "paid")->latest();
    }

    protected function getTableColumns(): array
    {
        return [
            TextColumn::make("tracking_serial")->label("کد پیگیری پست")->searchable(),
            TextColumn::make("user.name")->label("کاربر")->searchable(),
            TextColumn::make("price")
                ->searchable()
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
        ];
    }
}
