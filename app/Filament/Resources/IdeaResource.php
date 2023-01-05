<?php

namespace App\Filament\Resources;

use App\Filament\Resources\IdeaResource\Pages;
use App\Models\Idea;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class IdeaResource extends Resource
{
    protected static ?string $model = Idea::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('user_id')
                    ->required(),
                Forms\Components\TextInput::make('category_id')
                    ->required(),
                Forms\Components\TextInput::make('topic_id')
                    ->required(),
                Forms\Components\TextInput::make('status_id')
                    ->required(),
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('slug')
                    ->maxLength(255),
                Forms\Components\Textarea::make('description')
                    ->required()
                    ->maxLength(65535),
                Forms\Components\TextInput::make('spam_reports')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.last_name'),
                Tables\Columns\TextColumn::make('category.name'),
                Tables\Columns\TextColumn::make('topic.title'),
                Tables\Columns\TextColumn::make('status.name'),
                Tables\Columns\TextColumn::make('title'),
                Tables\Columns\TextColumn::make('slug'),
                Tables\Columns\TextColumn::make('description'),
                Tables\Columns\TextColumn::make('spam_reports'),
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
            'index' => Pages\ListIdeas::route('/'),
            'create' => Pages\CreateIdea::route('/create'),
            'view' => Pages\ViewIdea::route('/{record}'),
            'edit' => Pages\EditIdea::route('/{record}/edit'),
        ];
    }
}
