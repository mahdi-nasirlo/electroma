<?php

namespace App\Admin\Resources\Shop\CustomerResource\RelationManagers;

use App\Models\Comment;
use Filament\Forms;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\HasManyRelationManager;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\BooleanColumn;
use Filament\Tables\Columns\TextColumn;

class CommentsRelationManager extends HasManyRelationManager
{
    protected static string $relationship = 'comments';

    protected static ?string $recordTitleAttribute = 'title';

    public static function getModelLabel(): string
    {
        return "دیدگاه";
    }

    public static function getPluralModelLabel(): string
    {
        return "دیدگاه ها";
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Textarea::make('content')
                    ->label("دیدگاه")
                    ->required()
                    ->maxLength(255)
                    ->columnSpan([
                        'sm' => 2,
                    ]),
                Select::make('parent_id')
                    ->label('پاسخ به دیدگاه')
                    ->options(fn () => Comment::all()->pluck('content', 'id'))
                    ->searchable(),
                Toggle::make('is_visible')
                    ->label('قابل نمایش')
                    ->onIcon('heroicon-s-eye')
                    ->offIcon('heroicon-s-eye-off'),
                Hidden::make('user_id')->default(auth()->user()->id),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('content')
                    ->label("دیدگاه"),
                TextColumn::make('child.content')
                    ->label("پاسخ کاربران"),
                TextColumn::make("user.name")->label('کاربر'),
                BooleanColumn::make("is_visible")->label('قابل مشاهده'),
            ])
            ->filters([
                //
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
