<?php

declare(strict_types=1);

namespace App\Filament\Resources\OptionResource\Pages;

use App\Filament\Resources\OptionResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

final class EditOption extends EditRecord
{
    protected static string $resource = OptionResource::class;

    protected function getActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
