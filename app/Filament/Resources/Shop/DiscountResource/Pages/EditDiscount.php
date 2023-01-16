<?php

namespace App\Filament\Resources\Shop\DiscountResource\Pages;

use App\Filament\Resources\Shop\DiscountResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDiscount extends EditRecord
{
    protected static string $resource = DiscountResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
