<?php

namespace App\Admin\Resources\Shop\DiscountResource\Pages;

use App\Admin\Resources\Shop\DiscountResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateDiscount extends CreateRecord
{
    protected static string $resource = DiscountResource::class;
}
