<?php

namespace App\Filament\Resources\FlashcardResource\Pages;

use App\Filament\Resources\FlashcardResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFlashcard extends EditRecord
{
    protected static string $resource = FlashcardResource::class;

    protected function getActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
