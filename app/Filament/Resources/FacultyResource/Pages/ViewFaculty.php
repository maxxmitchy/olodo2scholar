<?php

namespace App\Filament\Resources\FacultyResource\Pages;

use App\Filament\Resources\FacultyResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewFaculty extends ViewRecord
{
    protected static string $resource = FacultyResource::class;

    protected function getActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
