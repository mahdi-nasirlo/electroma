<?php

namespace App\Admin\Resources\Information\InfographicResource\Pages;

use App\Admin\Resources\Information\InfographicResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListInfographics extends ListRecords
{
    protected static string $resource = InfographicResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
