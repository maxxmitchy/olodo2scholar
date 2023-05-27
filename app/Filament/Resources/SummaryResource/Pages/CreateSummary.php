<?php

declare(strict_types=1);

namespace App\Filament\Resources\SummaryResource\Pages;

use App\Filament\Resources\SummaryResource;
use Filament\Resources\Pages\CreateRecord;

final class CreateSummary extends CreateRecord
{
    protected static string $resource = SummaryResource::class;
}
