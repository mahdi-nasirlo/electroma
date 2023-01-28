<?php

namespace App\Filament\Resources\Service;

use App\Filament\Resources\Service\ServiceRequestResource\Pages;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables\Columns\BooleanColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\Action;
use Filament\Notifications\Notification;
use Modules\Service\Entities\Service;

class ServiceRequestResource extends Resource
{
    protected static ?string $model = Service::class;

    protected static ?string $navigationIcon = 'heroicon-o-ticket';

    protected static ?string $slug = 'service/items/request';

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $navigationGroup = 'خدمات';

    protected static ?int $navigationSort = 0;

    protected static ?string $inverseRelationship = 'section';

    public static function getModelLabel(): string
    {
        return "درخواست خدمات";
    }

    public static function getPluralModelLabel(): string
    {
        return "درخواست های خدمات";
    }

    protected static function getNavigationBadge(): ?string
    {
        return Service::all()->where("status", false)->count();
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
                TextColumn::make("name")->label("نام")->searchable(),
                TextColumn::make("mobile")->label("شماره همراه")->searchable(),
                TextColumn::make("items.name")->label("سرویس")->searchable(),
                TextColumn::make("message")->label("پیام")->searchable(),
                BooleanColumn::make("status")->label("وضعیت رسیدگی")->sortable()
            ])
            ->filters([
                //
            ])
            ->actions([
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
            'index' => Pages\ListServiceRequests::route('/'),
        ];
    }
}
