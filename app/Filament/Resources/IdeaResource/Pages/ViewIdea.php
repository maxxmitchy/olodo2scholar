<?php

namespace App\Filament\Resources\IdeaResource\Pages;

use App\Filament\Resources\IdeaResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewIdea extends ViewRecord
{
    protected static string $resource = IdeaResource::class;

    protected function getActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
