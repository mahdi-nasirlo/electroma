<?php

namespace App\Admin\Resources\Blog\CategoriesResource\Pages;

use App\Admin\Resources\Blog\CategoriesResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;
use Modules\Blog\Entities\Category;

class EditCategories extends EditRecord
{
    protected static string $resource = CategoriesResource::class;

    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        if ($data['parent_id']) {
            $parent = Category::find($data['parent_id']);
            $parent->appendNode($record);
        }

        $record->update($data);

        return $record;
    }

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
