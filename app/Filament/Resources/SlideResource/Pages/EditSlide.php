<?php

declare(strict_types=1);

namespace App\Filament\Resources\SlideResource\Pages;

use App\Filament\Resources\SlideResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

final class EditSlide extends EditRecord
{
    protected static string $resource = SlideResource::class;

    protected function getActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
