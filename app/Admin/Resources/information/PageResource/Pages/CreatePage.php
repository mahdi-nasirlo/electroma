<?php

namespace App\Admin\Resources\Information\PageResource\Pages;

use App\Admin\Resources\Information\PageResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePage extends CreateRecord
{
    protected static string $resource = PageResource::class;
}
