<?php

namespace App\Filament\Resources\IdeaResource\Pages;

use App\Filament\Resources\IdeaResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditIdea extends EditRecord
{
    protected static string $resource = IdeaResource::class;

    protected function getActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
