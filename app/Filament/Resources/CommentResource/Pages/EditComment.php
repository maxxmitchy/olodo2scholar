<?php

declare(strict_types=1);

namespace App\Filament\Resources\CommentResource\Pages;

use App\Filament\Resources\CommentResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

final class EditComment extends EditRecord
{
    protected static string $resource = CommentResource::class;

    protected function getActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
