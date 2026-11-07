<?php

namespace App\Filament\Resources\Tugaskus\Schemas;

use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class TugaskuForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nama')
                    ->required(),
                Toggle::make('is_completed')
                    ->label('Tugas Selesai')
                    ->default(false),
            ]);
    }
}

