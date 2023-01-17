<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FlashcardResource\Pages;
use App\Filament\Resources\FlashcardResource\RelationManagers;
use App\Models\Flashcard;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FlashcardResource extends Resource
{
    protected static ?string $model = Flashcard::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?string $navigationGroup = 'Content';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('topic_id')
                    ->relationship('topic', 'title')
                    ->required(),
                Forms\Components\TextInput::make('concept')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('definition')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('image')
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('topic_id'),
                Tables\Columns\TextColumn::make('concept'),
                Tables\Columns\TextColumn::make('definition'),
                Tables\Columns\TextColumn::make('image'),
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
            'index' => Pages\ListFlashcards::route('/'),
            'create' => Pages\CreateFlashcard::route('/create'),
            'view' => Pages\ViewFlashcard::route('/{record}'),
            'edit' => Pages\EditFlashcard::route('/{record}/edit'),
        ];
    }
}
