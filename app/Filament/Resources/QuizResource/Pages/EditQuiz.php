<?php

declare(strict_types=1);

namespace App\Filament\Resources\QuizResource\Pages;

use App\Filament\Resources\QuizResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

final class EditQuiz extends EditRecord
{
    protected static string $resource = QuizResource::class;

    protected function getActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
