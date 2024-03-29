<?php

declare(strict_types=1);

namespace App\Filament\Resources\QuestionResource\RelationManagers;

use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables;

final class OptionsRelationManager extends RelationManager
{
    protected static string $relationship = 'options';

    protected static ?string $recordTitleAttribute = 'body';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('body')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('explanation')
                    ->maxLength(65535),
                Forms\Components\Toggle::make('correct_option'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('body'),
                Tables\Columns\IconColumn::make('correct_option')
                    ->boolean(),
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
