<?php

namespace App\Admin\Resources\Shop\DeliveryResource\Pages;

use App\Admin\Resources\Shop\DeliveryResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateDelivery extends CreateRecord
{
    protected static string $resource = DeliveryResource::class;
}
