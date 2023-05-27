<?php

declare(strict_types=1);

namespace App\Filament\Resources\UniversityResource\Pages;

use App\Filament\Resources\UniversityResource;
use Filament\Resources\Pages\CreateRecord;

final class CreateUniversity extends CreateRecord
{
    protected static string $resource = UniversityResource::class;
}
