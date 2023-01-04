<?php

namespace App\Filament\Resources\UniversityResource\Pages;

use App\Filament\Resources\UniversityResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewUniversity extends ViewRecord
{
    protected static string $resource = UniversityResource::class;

    protected function getActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
