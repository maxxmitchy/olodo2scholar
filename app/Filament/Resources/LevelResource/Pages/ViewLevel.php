<?php

namespace App\Filament\Resources\LevelResource\Pages;

use App\Filament\Resources\LevelResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewLevel extends ViewRecord
{
    protected static string $resource = LevelResource::class;

    protected function getActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
