<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\CommentResource\Pages;
use App\Models\Comment;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

final class CommentResource extends Resource
{
    protected static ?string $model = Comment::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?string $navigationGroup = 'Discussion';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('status_id')
                    ->required(),
                Forms\Components\Select::make('parent_id')
                    ->relationship('parent', 'id'),
                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'id'),
                Forms\Components\TextInput::make('commentable_type')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('commentable_id')
                    ->required(),
                Forms\Components\Textarea::make('content')
                    ->required(),
                Forms\Components\TextInput::make('spam_reports')
                    ->required(),
                Forms\Components\Toggle::make('is_status_update')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('status_id'),
                Tables\Columns\TextColumn::make('parent.id'),
                Tables\Columns\TextColumn::make('user.id'),
                Tables\Columns\TextColumn::make('commentable_type'),
                Tables\Columns\TextColumn::make('commentable_id'),
                Tables\Columns\TextColumn::make('content'),
                Tables\Columns\TextColumn::make('spam_reports'),
                Tables\Columns\IconColumn::make('is_status_update')
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime(),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->dateTime(),
            ])
            ->filters([

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

        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListComments::route('/'),
            'create' => Pages\CreateComment::route('/create'),
            'view' => Pages\ViewComment::route('/{record}'),
            'edit' => Pages\EditComment::route('/{record}/edit'),
        ];
    }
}
