<?php

namespace App\Filament\Resources\Shop\CourceResource\Pages;

use App\Filament\Resources\Shop\CourceResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCource extends EditRecord
{
    protected static string $resource = CourceResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
