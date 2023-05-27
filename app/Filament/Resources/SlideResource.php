<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\SlideResource\Pages;
use App\Models\Slide;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

final class SlideResource extends Resource
{
    protected static ?string $model = Slide::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Select::make('summary_id')->relationship('summary', 'title'),

            Forms\Components\TextInput::make('title')->maxLength(255),

            Forms\Components\Toggle::make('type')->label('Image Based Slide'),

            Forms\Components\RichEditor::make('body')
                ->toolbarButtons(
                    [
                        'bold',
                        'bulletList', 'codeBlock', 'italic', 'orderedList', 'redo', 'undo']
                )
                ->required()->maxLength(320),

            Forms\Components\FileUpload::make('image'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('summary.title'),
                Tables\Columns\TextColumn::make('title'),
                Tables\Columns\TextColumn::make('body'),
                Tables\Columns\TextColumn::make('image'),
            ])
            ->filters([

            ])
            ->actions([Tables\Actions\ViewAction::make(), Tables\Actions\EditAction::make()])
            ->bulkActions([Tables\Actions\DeleteBulkAction::make()]);
    }

    public static function getRelations(): array
    {
        return [

        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSlides::route('/'),
            'create' => Pages\CreateSlide::route('/create'),
            'view' => Pages\ViewSlide::route('/{record}'),
            'edit' => Pages\EditSlide::route('/{record}/edit'),
        ];
    }
}
