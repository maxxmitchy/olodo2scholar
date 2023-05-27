<?php

declare(strict_types=1);

namespace App\Filament\Resources\FaqResource\Pages;

use App\Filament\Resources\FaqResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

final class EditFaq extends EditRecord
{
    protected static string $resource = FaqResource::class;

    protected function getActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
