<?php

namespace App\Filament\Resources\Tugaskus\Pages;

use App\Filament\Resources\Tugaskus\TugaskuResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListTugaskus extends ListRecords
{
    protected static string $resource = TugaskuResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
