<?php

namespace App\Filament\Resources\Blog\CategoriesResource\Pages;

use App\Filament\Resources\Blog\CategoriesResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateCategories extends CreateRecord
{
    protected static string $resource = CategoriesResource::class;
}
