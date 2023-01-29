<?php

namespace App\Admin\Resources\Shop\CategoryResource\Pages;

use App\Admin\Resources\Shop\CategoryResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateCategory extends CreateRecord
{
    protected static string $resource = CategoryResource::class;
}
