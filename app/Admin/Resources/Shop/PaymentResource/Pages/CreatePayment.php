<?php

namespace App\Admin\Resources\Shop\PaymentResource\Pages;

use App\Admin\Resources\Shop\PaymentResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePayment extends CreateRecord
{
    protected static string $resource = PaymentResource::class;
}
