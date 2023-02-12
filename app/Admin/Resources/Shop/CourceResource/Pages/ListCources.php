<?php

namespace App\Admin\Resources\Shop\CourceResource\Pages;

use App\Admin\Resources\Shop\CourceResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCources extends ListRecords
{
    protected static string $resource = CourceResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
