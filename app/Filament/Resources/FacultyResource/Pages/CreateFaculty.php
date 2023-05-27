<?php

declare(strict_types=1);

namespace App\Filament\Resources\FacultyResource\Pages;

use App\Filament\Resources\FacultyResource;
use Filament\Resources\Pages\CreateRecord;

final class CreateFaculty extends CreateRecord
{
    protected static string $resource = FacultyResource::class;
}
