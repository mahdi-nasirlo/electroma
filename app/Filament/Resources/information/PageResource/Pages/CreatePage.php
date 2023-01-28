<?php

namespace App\Filament\Resources\Information\PageResource\Pages;

use App\Filament\Resources\Information\PageResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePage extends CreateRecord
{
    protected static string $resource = PageResource::class;
}
