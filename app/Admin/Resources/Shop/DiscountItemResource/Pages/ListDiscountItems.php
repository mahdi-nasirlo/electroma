<?php

namespace App\Admin\Resources\Shop\DiscountItemResource\Pages;

use App\Admin\Resources\Shop\DiscountItemResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDiscountItems extends ListRecords
{
    protected static string $resource = DiscountItemResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
