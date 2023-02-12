<?php

namespace App\Admin\Resources\Blog\CategoriesResource\RelationManagers;

use Ariaieboy\FilamentJalaliDatetime\JalaliDateTimeColumn;
use Ariaieboy\FilamentJalaliDatetimepicker\Forms\Components\JalaliDatePicker;
use Filament\Forms;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\SpatieTagsInput;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Modules\Blog\Entities\Category;
use Modules\Blog\Entities\Post;
use Mohamedsabil83\FilamentFormsTinyeditor\Components\TinyEditor;

class PostsRelationManager extends RelationManager
{
    protected static string $relationship = 'posts';

    protected static ?string $recordTitleAttribute = 'title';

    public static function getModelLabel(): string
    {
        return "مقاله";
    }

    public static function getPluralModelLabel(): string
    {
        return "مقالات";
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make()
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->label("عنوان")
                            ->required()
                            ->reactive()
                            ->afterStateUpdated(fn ($state, callable $set) => $set('slug', SlugService::createSlug(Post::class, 'slug', $state == null ? "" : $state))),
                        Forms\Components\TextInput::make('slug')
                            ->label("نامک (URL)")
                            // ->disabled()
                            ->required()
                            ->unique(Post::class, 'slug', fn ($record) => $record),

                        TinyEditor::make('content')
                            ->label("محتوا")
                            ->required()
                            ->columnSpan([
                                'sm' => 2,
                            ]),

                        Forms\Components\TextInput::make('read_time')
                            ->label("زمان مطالعه")
                            ->numeric()
                            ->rule('min:1')
                            ->required(),
                        // ->gt('zero'),

                        Hidden::make("blog_author_id")->default(auth()->user()->id),

                        Forms\Components\Select::make('blog_category_id')
                            ->label("دسته بندی")
                            ->options(function (callable $get) {
                                return Category::all()->pluck("name", "id")->toArray();
                            })
                            ->searchable()
                            ->required(),
                        JalaliDatePicker::make('published_at')
                            ->label('تاریخ انتشار')
                            ->required(),
                        SpatieTagsInput::make('tags')
                            ->label('تگ ها')
                            ->required(),
                    ])
                    ->columns([
                        'sm' => 2,
                    ])
                    ->columnSpan([
                        'sm' => 2,
                    ]),
                Forms\Components\Card::make()
                    ->schema([
                        FileUpload::make('image')
                            ->required()
                            ->label('عکس شاخص')
                            ->image(),

                        Forms\Components\Placeholder::make('created_at')
                            ->label('ساخته شده :')
                            ->content(fn (?Post $record): string => $record ? $record->created_at->diffForHumans() : '-'),
                        Forms\Components\Placeholder::make('updated_at')
                            ->label('بروزرسانی شده:')
                            ->content(fn (?Post $record): string => $record ? $record->updated_at->diffForHumans() : '-'),
                    ])
                    ->columnSpan(1),
            ])
            ->columns([
                'md' => 3,
                'lg' => null,
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->label('عکس شاخص'),

                Tables\Columns\TextColumn::make('title')
                    ->label("عنوان")
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('view')
                    ->label("بازدید")
                    ->sortable(),
                Tables\Columns\TextColumn::make('slug')
                    ->label("نامک")
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('author.name')
                    ->label("نویسنده")
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('category.name')
                    ->label("دسته بندی")
                    ->searchable()
                    ->sortable(),
                JalaliDateTimeColumn::make('published_at')->date()
                    ->sortable()
                    ->label("تاریخ انتشار")
                    ->date(),
                JalaliDateTimeColumn::make('created_at')->date()
                    ->sortable()
                    ->label("تاریخ ثبت")
                    ->date(),
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
