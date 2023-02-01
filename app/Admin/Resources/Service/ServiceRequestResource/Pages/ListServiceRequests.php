<?php

namespace App\Admin\Resources\Service\ServiceRequestResource\Pages;

use App\Admin\Resources\Service\ServiceRequestResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListServiceRequests extends ListRecords
{
    protected static string $resource = ServiceRequestResource::class;

    protected function getActions(): array
    {
        return [];
    }
}
