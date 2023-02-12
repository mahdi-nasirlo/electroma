<?php

namespace App\Admin\Resources\Shop\DiscountItemResource\Pages;

use App\Admin\Resources\Shop\DiscountItemResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateDiscountItem extends CreateRecord
{
    protected static string $resource = DiscountItemResource::class;
}
