<?php

namespace App\Filament\Resources\Pilihans\Schemas;
use Filament\Forms\Components\TextInput;

use Filament\Schemas\Schema;

class PilihanForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nama')
                    ->required(),
            ]);
    }
}