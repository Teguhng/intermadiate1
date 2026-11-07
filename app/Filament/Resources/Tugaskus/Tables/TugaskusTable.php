<?php

namespace App\Filament\Resources\Tugaskus\Tables;

use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Table;


class TugaskusTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama')
                    ->searchable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                ToggleColumn::make('is_completed')
                    ->label('Status Selesai'),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }


public static function table(Table $table): Table
{
    return $table
        ->columns([
            TextColumn::make('nama')
                ->searchable(),

            ToggleColumn::make('is_completed')
                ->label('Status Selesai')
                // Memastikan saat toggle diklik, halaman direfresh agar urutannya langsung berpindah
                ->afterStateUpdated(function ($record, $state) {
                    // meng-update status
                }),
        ])
        ->defaultSort('is_completed', 'asc'); // 0 (belum selesai) di atas, 1 (selesai) di bawah
}
}

