<?php

namespace App\Filament\Resources\Service\ItemServiceResource\Pages;

use App\Filament\Resources\Service\ItemServiceResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditItemService extends EditRecord
{
    protected static string $resource = ItemServiceResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
