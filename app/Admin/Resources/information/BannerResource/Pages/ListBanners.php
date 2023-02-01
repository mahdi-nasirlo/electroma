<?php

namespace App\Admin\Resources\Information\BannerResource\Pages;

use App\Admin\Resources\Information\BannerResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBanners extends ListRecords
{
    protected static string $resource = BannerResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
