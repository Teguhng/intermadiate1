<?php

namespace App\Filament\Resources\Pilihans;

use App\Filament\Resources\Pilihans\Pages\CreatePilihan;
use App\Filament\Resources\Pilihans\Pages\EditPilihan;
use App\Filament\Resources\Pilihans\Pages\ListPilihans;
use App\Filament\Resources\Pilihans\Schemas\PilihanForm;
use App\Filament\Resources\Pilihans\Tables\PilihansTable;
use App\Models\Pilihan;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class PilihanResource extends Resource
{
    protected static ?string $model = Pilihan::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return PilihanForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PilihansTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPilihans::route('/'),
            'create' => CreatePilihan::route('/create'),
            'edit' => EditPilihan::route('/{record}/edit'),
        ];
    }
}
