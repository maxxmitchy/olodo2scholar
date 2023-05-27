<?php

declare(strict_types=1);

namespace App\Filament\Resources\LevelResource\Pages;

use App\Filament\Resources\LevelResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

final class EditLevel extends EditRecord
{
    protected static string $resource = LevelResource::class;

    protected function getActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
