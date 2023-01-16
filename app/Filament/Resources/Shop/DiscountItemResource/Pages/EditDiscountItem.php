<?php

namespace App\Filament\Resources\Shop\DiscountItemResource\Pages;

use App\Filament\Resources\Shop\DiscountItemResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDiscountItem extends EditRecord
{
    protected static string $resource = DiscountItemResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
