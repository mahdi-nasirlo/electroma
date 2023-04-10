<?php

namespace App\Admin\Resources\Shop\DeliveryResource\Pages;

use App\Admin\Resources\Shop\DeliveryResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDelivery extends EditRecord
{
    protected static string $resource = DeliveryResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
