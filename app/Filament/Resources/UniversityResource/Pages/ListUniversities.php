<?php

declare(strict_types=1);

namespace App\Filament\Resources\UniversityResource\Pages;

use App\Filament\Resources\UniversityResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

final class ListUniversities extends ListRecords
{
    protected static string $resource = UniversityResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
