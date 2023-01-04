<?php

namespace App\Filament\Resources\SummaryResource\Pages;

use App\Filament\Resources\SummaryResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewSummary extends ViewRecord
{
    protected static string $resource = SummaryResource::class;

    protected function getActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
