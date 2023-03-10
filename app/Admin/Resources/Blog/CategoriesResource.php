<?php

namespace App\Admin\Resources\Blog;

use App\Admin\Resources\Blog\CategoriesResource\Pages;
use App\Admin\Resources\Blog\CategoriesResource\RelationManagers\PostsRelationManager;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use Ariaieboy\FilamentJalaliDatetime\JalaliDateTimeColumn;
use Closure;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Columns\IconColumn;
use Illuminate\Database\Eloquent\Model;
use Modules\Blog\Entities\Category;
use Mohamedsabil83\FilamentFormsTinyeditor\Components\TinyEditor;
use RalphJSmit\Filament\SEO\SEO;


class CategoriesResource extends Resource
{
    protected static ?string $model = Category::class;

    protected static ?string $slug = 'blog/categories';

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $navigationGroup = 'بلاگ';

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?int $navigationSort = 1;

    public static function getModelLabel(): string
    {
        return "دسته بندی";
    }

    public static function getPluralModelLabel(): string
    {
        return "دسته بندی ها";
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make()
                    ->schema([
                        Forms\Components\Grid::make()
                            ->schema([
                                Forms\Components\TextInput::make('name')
                                    ->label('عنوان')
                                    ->reactive()
                                    ->afterStateUpdated(fn ($state, callable $set) => $set('slug', SlugService::createSlug(Category::class, 'slug', $state == null ? "" : $state))),
                                Forms\Components\TextInput::make('slug')
                                    ->label('نامک')
                                    ->disabled()
                                    ->required()
                                    ->unique(Category::class, 'slug', fn ($record) => $record),
                            ]),
                        Forms\Components\Select::make('parent_id')
                            ->searchable()
                            ->preload()
                            ->label('دسته بندی پدر')
                            ->columnSpan(2)
                            ->relationship(
                                'parent',
                                'name',
                                fn (Builder $query, ?Category $record) => $query->whereNot('id', $record ? $record->id : null)
                            ),
                        // ->options(fn (?Category $record) => Category::whereNot('id', $record ? $record->id : null)->get()->pluck('name', 'id')->toArray()),
                        Forms\Components\Toggle::make('is_visible')
                            ->label('قابل نمایش برای کاربران.')
                            ->onIcon('heroicon-s-eye')
                            ->offIcon('heroicon-s-eye-off')
                            ->default(true),
                        TinyEditor::make('description')
                            ->label("محتوا")
                            ->columnSpan([
                                'sm' => 2,
                            ]),
                    ])
                    ->columnSpan([
                        'sm' => 2,
                    ]),
                Forms\Components\Card::make()
                    ->schema([
                        SEO::make(),
                        Forms\Components\Placeholder::make('created_at')
                            ->label('ساخته شده :')
                            ->content(fn (?Category $record): string => $record ? $record->created_at->diffForHumans() : '-'),
                        Forms\Components\Placeholder::make('updated_at')
                            ->label('بروزرسانی شده:')
                            ->content(fn (?Category $record) => $record ? $record->updated_at->diffForHumans() : '-')
                    ])
                    ->columnSpan(1),
            ])
            ->columns([
                'sm' => 3,
                'lg' => null,
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('عنوان')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('parent.name')
                    ->label('دسته بندی اصلی')
                    ->searchable()
                    ->sortable(),
                IconColumn::make('is_visible')
                    ->label('عمومی')
                    ->sortable(),
                JalaliDateTimeColumn::make('updated_at')->date()
                    ->label('بروزرسانی در')
                    ->date()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                DeleteAction::make()
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            PostsRelationManager::class
        ];
    }

    protected static function getGlobalSearchEloquentQuery(): Builder
    {
        return parent::getGlobalSearchEloquentQuery()->with(['parent']);
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['name', 'parent.name'];
    }

    public static function getGlobalSearchResultDetails(Model $record): array
    {
        $details = [];

        if ($record->user) {
            $details['نویسنده'] = $record->user->name;
        }

        if ($record->category) {
            $details['دسته بندی'] = $record->category->name;
        }

        return $details;
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCategories::route('/'),
            'create' => Pages\CreateCategories::route('/create'),
            'edit' => Pages\EditCategories::route('/{record}/edit'),
        ];
    }
}
