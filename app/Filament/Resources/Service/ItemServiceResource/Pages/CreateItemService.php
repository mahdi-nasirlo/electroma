<?php

namespace App\Filament\Resources\Service\ItemServiceResource\Pages;

use App\Filament\Resources\Service\ItemServiceResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateItemService extends CreateRecord
{
    protected static string $resource = ItemServiceResource::class;
}
