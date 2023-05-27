<?php

declare(strict_types=1);

namespace App\Filament\Resources\SlideResource\Pages;

use App\Filament\Resources\SlideResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

final class ListSlides extends ListRecords
{
    protected static string $resource = SlideResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
