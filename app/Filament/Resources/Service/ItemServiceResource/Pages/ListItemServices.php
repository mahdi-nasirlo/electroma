<?php

namespace App\Filament\Resources\Service\ItemServiceResource\Pages;

use App\Filament\Resources\Service\ItemServiceResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListItemServices extends ListRecords
{
    protected static string $resource = ItemServiceResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
