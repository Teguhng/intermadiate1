<?php

namespace App\Filament\Resources\Pilihans\Pages;

use App\Filament\Resources\Pilihans\PilihanResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListPilihans extends ListRecords
{
    protected static string $resource = PilihanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
