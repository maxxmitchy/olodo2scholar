<?php

declare(strict_types=1);

namespace App\Filament\Resources\TopicResource\Pages;

use App\Filament\Resources\TopicResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

final class EditTopic extends EditRecord
{
    protected static string $resource = TopicResource::class;

    protected function getActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
