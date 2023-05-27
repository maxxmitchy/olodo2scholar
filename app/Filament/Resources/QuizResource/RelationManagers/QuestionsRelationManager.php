<?php

declare(strict_types=1);

namespace App\Filament\Resources\QuizResource\RelationManagers;

use App\Models\Quiz;
use Filament\Forms;
use Filament\Forms\Components\MorphToSelect;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables;

final class QuestionsRelationManager extends RelationManager
{
    protected static string $relationship = 'questions';

    protected static ?string $recordTitleAttribute = 'content';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Forms\Components\Textarea::make('content')
                    ->required(),
                Forms\Components\Textarea::make('explanation'),
                MorphToSelect::make('questionable')
                    ->types([
                        MorphToSelect\Type::make(Quiz::class)->titleColumnName('name'),
                    ]),
                Forms\Components\Select::make('question_type_id')
                    ->relationship('questionType', 'name')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('content'),
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
