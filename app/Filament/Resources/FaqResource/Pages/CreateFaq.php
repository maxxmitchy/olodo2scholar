<?php

declare(strict_types=1);

namespace App\Filament\Resources\FaqResource\Pages;

use App\Filament\Resources\FaqResource;
use Filament\Resources\Pages\CreateRecord;

final class CreateFaq extends CreateRecord
{
    protected static string $resource = FaqResource::class;
}
