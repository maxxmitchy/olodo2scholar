<?php

namespace App\Filament\Resources\OptionResource\Pages;

use App\Filament\Resources\OptionResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewOption extends ViewRecord
{
    protected static string $resource = OptionResource::class;

    protected function getActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
