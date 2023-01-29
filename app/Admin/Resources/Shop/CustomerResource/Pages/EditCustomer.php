<?php

namespace App\Admin\Resources\Shop\CustomerResource\Pages;

use App\Admin\Resources\Shop\CustomerResource;
use Filament\Resources\Pages\EditRecord;

class EditCustomer extends EditRecord
{
    protected static string $resource = CustomerResource::class;
}
