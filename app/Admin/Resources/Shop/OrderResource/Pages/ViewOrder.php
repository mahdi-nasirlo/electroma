<?php

namespace App\Admin\Resources\Shop\OrderResource\Pages;

use App\Admin\Resources\Shop\OrderResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewOrder extends ViewRecord
{
    protected static string $resource = OrderResource::class;
}