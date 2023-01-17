<?php

namespace App\Filament\Resources\FlashcardResource\Pages;

use App\Filament\Resources\FlashcardResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewFlashcard extends ViewRecord
{
    protected static string $resource = FlashcardResource::class;

    protected function getActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
