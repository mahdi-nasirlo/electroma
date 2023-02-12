<?php

namespace App\Admin\Resources\Shop\CustomerResource\Pages;

use App\Admin\Resources\Shop\CustomerResource;
use Filament\Resources\Pages\CreateRecord;

class CreateCustomer extends CreateRecord
{
    protected static string $resource = CustomerResource::class;
}
