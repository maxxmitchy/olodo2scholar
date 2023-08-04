<?php

declare(strict_types=1);

namespace App\Filament\Resources\SummaryResource\RelationManagers;

use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables;

final class SlidesRelationManager extends RelationManager
{
    protected static string $relationship = 'slides';

    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('summary_id')->relationship('summary', 'title'),

            Forms\Components\TextInput::make('title')->maxLength(255),

            Forms\Components\Toggle::make('type')->label('Image Based Slide'),

            Forms\Components\RichEditor::make('body')
                ->toolbarButtons(
                    [
                        'bold',
                        'bulletList', 'codeBlock', 'italic', 'orderedList', 'redo', 'undo']
                )
                ->required()->maxLength(620),

            Forms\Components\FileUpload::make('image'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title'),
            ])
            ->filters([

            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
}
