<?php

declare(strict_types=1);

namespace App\Filament\Resources\SummaryResource\Pages;

use App\Filament\Resources\SummaryResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

final class ListSummaries extends ListRecords
{
    protected static string $resource = SummaryResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
