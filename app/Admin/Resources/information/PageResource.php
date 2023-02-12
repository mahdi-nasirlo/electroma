<?php

namespace App\Admin\Resources\Information;

use App\Admin\Resources\Information\PageResource\Pages;
use App\Admin\Resources\Information\PageResource\RelationManagers;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Forms\Components\Card;
use Filament\Tables\Columns\TextColumn;
use Modules\Information\Entities\Page;
use Mohamedsabil83\FilamentFormsTinyeditor\Components\TinyEditor;

class PageResource extends Resource
{
    protected static ?string $model = Page::class;

    protected static ?string $navigationIcon = 'heroicon-o-paper-clip';

    protected static ?string $navigationGroup = 'بلاگ';

    public static function getModelLabel(): string
    {
        return "صفحه";
    }

    public static function getPluralModelLabel(): string
    {
        return "صفحات";
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()
                    ->schema([
                        TextInput::make("name")
                            ->label("عنوان")
                            ->reactive()
                            ->afterStateUpdated(fn ($state, callable $set) => $set('slug', SlugService::createSlug(Page::class, 'slug', $state == null ? "" : $state)))
                            ->required(),
                        TextInput::make("slug")
                            ->required()
                            ->unique(Page::class, 'slug', fn ($record) => $record)
                            ->label("url"),
                        TinyEditor::make("content")
                            ->label("محتوا")
                            ->columnSpan(2)
                    ])
                    ->columns(2)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make("name")
                    ->label("نام"),
                TextColumn::make("slug")
                    ->label("url"),
                TextColumn::make("content")
                    ->label("محتوا")
                    ->limit()
                    ->html()
            ])
            ->filters([
                //
            ])
            ->actions([
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
            'index' => Pages\ListPages::route('/'),
            'create' => Pages\CreatePage::route('/create'),
            'edit' => Pages\EditPage::route('/{record}/edit'),
        ];
    }
}
