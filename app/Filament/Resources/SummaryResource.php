<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SummaryResource\Pages;
use App\Filament\Resources\SummaryResource\RelationManagers;
use App\Models\Summary;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SummaryResource extends Resource
{
    protected static ?string $model = Summary::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('topic_id'),
                Forms\Components\TextInput::make('key')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('body')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('topic_id'),
                Tables\Columns\TextColumn::make('key'),
                Tables\Columns\TextColumn::make('title'),
                Tables\Columns\TextColumn::make('body'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
    
    public static function getRelations(): array
    {
        return [
            //
        ];
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSummaries::route('/'),
            'create' => Pages\CreateSummary::route('/create'),
            'view' => Pages\ViewSummary::route('/{record}'),
            'edit' => Pages\EditSummary::route('/{record}/edit'),
        ];
    }    
}
