<?php

namespace App\Filament\Resources\Tugaskus;

use App\Filament\Resources\Tugaskus\Pages\CreateTugasku;
use App\Filament\Resources\Tugaskus\Pages\EditTugasku;
use App\Filament\Resources\Tugaskus\Pages\ListTugaskus;
use App\Filament\Resources\Tugaskus\Schemas\TugaskuForm;
use App\Filament\Resources\Tugaskus\Tables\TugaskusTable;
use App\Models\Tugasku;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class TugaskuResource extends Resource
{
    protected static ?string $model = Tugasku::class;

    protected static ?string $navigationLabel = 'Tugasku';
    protected static ?string $modelLabel = 'Tugasku';
    protected static ?string $pluralModelLabel = 'Tugasku';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return TugaskuForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return TugaskusTable::configure($table);
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
            'index' => ListTugaskus::route('/'),
            'create' => CreateTugasku::route('/create'),
            'edit' => EditTugasku::route('/{record}/edit'),
        ];
    }


public static function getEloquentQuery(): Builder
{
    return parent::getEloquentQuery()
        ->orderBy('is_completed', 'asc') // Belum selesai (false/0) di atas, Selesai (true/1) di bawah
        ->orderBy('id', 'desc');          // Tugas terbaru yang belum selesai tetap berada paling atas
}
}
