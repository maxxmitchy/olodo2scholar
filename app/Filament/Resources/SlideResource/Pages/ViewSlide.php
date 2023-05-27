<?php

declare(strict_types=1);

namespace App\Filament\Resources\SlideResource\Pages;

use App\Filament\Resources\SlideResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ViewRecord;

final class ViewSlide extends ViewRecord
{
    protected static string $resource = SlideResource::class;

    protected function getActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
