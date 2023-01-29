<?php

namespace App\Admin\Resources\Service\ItemServiceResource\Pages;

use App\Admin\Resources\Service\ItemServiceResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateItemService extends CreateRecord
{
    protected static string $resource = ItemServiceResource::class;
}
