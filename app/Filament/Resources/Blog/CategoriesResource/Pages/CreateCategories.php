<?php

namespace App\Filament\Resources\Blog\CategoriesResource\Pages;

use App\Filament\Resources\Blog\CategoriesResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;
use Modules\Blog\Entities\Category;

class CreateCategories extends CreateRecord
{
    protected static string $resource = CategoriesResource::class;

    protected function handleRecordCreation(array $data): Model
    {
        $category = static::getModel()::create($data);

        if ($data['parent_id']) {
            $parent = Category::find($data['parent_id']);
            $parent->appendNode($category);
        }

        return $category;
    }
}
