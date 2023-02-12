<?php

namespace App\Admin\Resources\Shop\ProductResource\Pages;

use App\Admin\Resources\Shop\ProductResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateProduct extends CreateRecord
{
    protected static string $resource = ProductResource::class;
}
