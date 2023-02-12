<?php

namespace App\Admin\Widgets;

use BezhanSalleh\FilamentShield\Traits\HasWidgetShield;
use Filament\Notifications\Notification;
use Filament\Tables;
use Filament\Tables\Columns\BooleanColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Actions\Action;
use Modules\Service\Entities\Service;

class LatestRequesth extends BaseWidget
{
    use HasWidgetShield;

    protected static ?string $heading = "اخرین درخواست تعمیرکار با وضعیت باز";

    protected static ?int $sort = 1;

    protected function getTableQuery(): Builder
    {
        return Service::query()->where("status", false)->latest();
    }

    protected function getTableColumns(): array
    {
        return [
            TextColumn::make("name")->label("نام")->searchable(),
            TextColumn::make("mobile")->label("شماره همراه")->searchable(),
            TextColumn::make("items.name")->label("سرویس")->searchable(),
            TextColumn::make("message")->label("پیام")->searchable(),
            BooleanColumn::make("status")->label("وضعیت رسیدگی")->sortable()
        ];
    }

    protected function getTableActions(): array
    {
        return [
            Action::make("رسیدگی_شد")
                ->action(function (Service $record) {
                    if (!$record->status) {
                        Notification::make()
                            ->title('وضعیت رسیدگی درخواست به "رسیدگی شد" تغییر کرد')
                            ->success()
                            ->send();
                    } else {
                        Notification::make()
                            ->warning()
                            ->title("وضعیت قبلا تغییر کرده است")
                            ->send();
                    }

                    $record->update(['status' => true]);
                })->requiresConfirmation()
        ];
    }
}
