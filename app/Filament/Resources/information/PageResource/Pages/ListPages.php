<?php

namespace App\Filament\Resources\Information\PageResource\Pages;

use App\Filament\Resources\Information\PageResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPages extends ListRecords
{
    protected static string $resource = PageResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
