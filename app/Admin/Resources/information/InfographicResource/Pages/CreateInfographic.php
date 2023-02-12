<?php

namespace App\Admin\Resources\Information\InfographicResource\Pages;

use App\Admin\Resources\Information\InfographicResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateInfographic extends CreateRecord
{
    protected static string $resource = InfographicResource::class;
}
