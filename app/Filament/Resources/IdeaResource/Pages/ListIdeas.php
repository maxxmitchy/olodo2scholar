<?php

namespace App\Filament\Resources\IdeaResource\Pages;

use App\Filament\Resources\IdeaResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListIdeas extends ListRecords
{
    protected static string $resource = IdeaResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
