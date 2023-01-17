<?php

namespace App\Filament\Widgets;

use App\Models\User;
use Closure;
use Filament\Tables;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;

class LatestUsers extends BaseWidget
{
    protected int | string | array $columnSpan = 'full';

    protected function getTableQuery(): Builder
    {
        return User::query()->latest();
    }

    protected function getTableColumns(): array
    {
        return [
            Tables\Columns\TextColumn::make('id'),
            Tables\Columns\TextColumn::make('first_name')
                ->label('First Name'),
            Tables\Columns\TextColumn::make('last_name')
                ->label('Last Name'),
        ];
    }
}
