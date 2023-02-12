<?php

namespace App\Admin\Resources\Information\BannerResource\Pages;

use App\Admin\Resources\Information\BannerResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateBanner extends CreateRecord
{
    protected static string $resource = BannerResource::class;
}
