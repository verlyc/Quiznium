<?php

namespace App\Filament\Resources;

use App\Enums\QuestionTypeEnum;
use App\Filament\Resources\QuestionResource\Pages;
use App\Models\Question;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class QuestionResource extends Resource
{
    protected static ?string $model = Question::class;
    protected static ?string $label = "Qestions";
    protected static ?int $navigationSort = 3;


    protected static ?string $navigationIcon = 'solar-question-square-line-duotone';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('quiz_id')
                    ->required()
                    ->relationship('quiz', 'title')
                    ->native(false),
                Forms\Components\Select::make('type')
                    ->options([
                        QuestionTypeEnum::single_choice->name => "Question à choix unique",
                        QuestionTypeEnum::multiple_choice->name => "Question à choix multile",
                    ])
                    ->required()->native(false),
                Forms\Components\TextInput::make('question')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('duration')->label("Durée (en seconde)")
                    ->numeric()
                    ->default(null),
                Forms\Components\FileUpload::make('image')
                    ->image()->imageCropAspectRatio("1:1")->columnSpanFull(),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('question')
                    ->searchable(),
                Tables\Columns\TextColumn::make('type'),
                Tables\Columns\ImageColumn::make('image'),
                Tables\Columns\TextColumn::make('quiz_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('duration')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListQuestions::route('/'),
            'create' => Pages\CreateQuestion::route('/create'),
            'edit' => Pages\EditQuestion::route('/{record}/edit'),
        ];
    }
}
