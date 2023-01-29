<?php

namespace App\Admin\Resources\Shop\PaymentResource\Pages;

use App\Admin\Resources\Shop\PaymentResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPayment extends EditRecord
{
    protected static string $resource = PaymentResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
