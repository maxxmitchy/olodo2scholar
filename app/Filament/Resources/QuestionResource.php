<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\Quiz;
use Filament\Tables;
use App\Models\Question;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\MorphToSelect;
use App\Filament\Resources\QuestionResource\Pages;
use App\Filament\Resources\QuestionResource\RelationManagers;

class QuestionResource extends Resource
{
    protected static ?string $model = Question::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

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
                Tables\Columns\TextColumn::make('key'),
                Tables\Columns\TextColumn::make('content')->searchable(),
                Tables\Columns\TextColumn::make('explanation'),
                Tables\Columns\TextColumn::make('questionable_id'),
                Tables\Columns\TextColumn::make('questionable_type'),
                Tables\Columns\TextColumn::make('questionType.name'),
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
            RelationManagers\OptionsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListQuestions::route('/'),
            'create' => Pages\CreateQuestion::route('/create'),
            'view' => Pages\ViewQuestion::route('/{record}'),
            'edit' => Pages\EditQuestion::route('/{record}/edit'),
        ];
    }
}
