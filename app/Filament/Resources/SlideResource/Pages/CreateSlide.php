<?php

declare(strict_types=1);

namespace App\Filament\Resources\SlideResource\Pages;

use App\Filament\Resources\SlideResource;
use Filament\Resources\Pages\CreateRecord;

final class CreateSlide extends CreateRecord
{
    protected static string $resource = SlideResource::class;
}
