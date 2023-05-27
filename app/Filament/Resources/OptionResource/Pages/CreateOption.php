<?php

declare(strict_types=1);

namespace App\Filament\Resources\OptionResource\Pages;

use App\Filament\Resources\OptionResource;
use Filament\Resources\Pages\CreateRecord;

final class CreateOption extends CreateRecord
{
    protected static string $resource = OptionResource::class;
}
