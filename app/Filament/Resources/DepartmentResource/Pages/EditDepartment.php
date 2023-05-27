<?php

declare(strict_types=1);

namespace App\Filament\Resources\DepartmentResource\Pages;

use App\Filament\Resources\DepartmentResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

final class EditDepartment extends EditRecord
{
    protected static string $resource = DepartmentResource::class;

    protected function getActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
