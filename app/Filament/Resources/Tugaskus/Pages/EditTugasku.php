<?php

namespace App\Filament\Resources\Tugaskus\Pages;

use App\Filament\Resources\Tugaskus\TugaskuResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditTugasku extends EditRecord
{
    protected static string $resource = TugaskuResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
