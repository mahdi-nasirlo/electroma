<?php

namespace App\Admin\Resources\Blog\CategoriesResource\Pages;

use App\Admin\Resources\Blog\CategoriesResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCategories extends ListRecords
{
    protected static string $resource = CategoriesResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
