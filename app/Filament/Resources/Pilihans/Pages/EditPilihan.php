<?php

namespace App\Filament\Resources\Pilihans\Pages;

use App\Filament\Resources\Pilihans\PilihanResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditPilihan extends EditRecord
{
    protected static string $resource = PilihanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
