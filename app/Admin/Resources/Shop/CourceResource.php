<?php

namespace App\Admin\Resources\Shop;

use App\Admin\Resources\Shop\CourceResource\RelationManagers\CommentsRelationManager;
use App\Admin\Resources\Shop\CourceResource\Pages;
use App\Admin\Resources\Shop\CourceResource\RelationManagers\OrdersRelationManager;
use Ariaieboy\FilamentJalaliDatetime\JalaliDateTimeColumn;
use Ariaieboy\FilamentJalaliDatetimepicker\Forms\Components\JalaliDatePicker;
use Ariaieboy\FilamentJalaliDatetimepicker\Forms\Components\JalaliDateTimePicker;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\SpatieTagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TextInput\Mask;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use RalphJSmit\Filament\SEO\SEO;
use Filament\Tables\Columns\TextColumn;
use Mohamedsabil83\FilamentFormsTinyeditor\Components\TinyEditor;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Modules\Course\Entities\Course;
use Morilog\Jalali\Jalalian;

class CourceResource extends Resource
{
    protected static ?string $model = Course::class;

    protected static ?string $slug = 'shop/courses';

    protected static ?string $recordTitleAttribute = 'title';

    protected static ?string $navigationGroup = 'فروشگاه';

    protected static ?string $navigationIcon = 'heroicon-o-video-camera';

    protected static ?int $navigationSort = 2;

    protected static ?string $inverseRelationship = 'section';

    public static function getModelLabel(): string
    {
        return "دوره";
    }

    public static function getPluralModelLabel(): string
    {
        return "دوره ها";
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make()
                    ->schema([
                        Hidden::make('user_id')->default(auth()->user()->id),
                        Forms\Components\TextInput::make('title')
                            ->label("عنوان")
                            ->required()
                            ->reactive()
                            ->afterStateUpdated(fn ($state, callable $set) => $set('slug', SlugService::createSlug(Course::class, 'slug', $state == null ? "" : $state))),
                        Forms\Components\TextInput::make('slug')
                            ->label("نامک (URL)")
                            // ->disabled()
                            ->required()
                            ->unique(Course::class, 'slug', fn ($record) => $record),
                        TinyEditor::make('desc')
                            ->label("محتوا")
                            ->required()
                            ->columnSpan([
                                'sm' => 2,
                            ]),
                        Textarea::make("short_desc")
                            ->label("توضیح کوتاه")
                            ->required()
                            ->columnSpan(['sm' => 2]),

                        TextInput::make('price')
                            ->mask(
                                fn (Mask $mask) => $mask
                                    ->numeric()
                                    ->thousandsSeparator(','), // Add a separator for thousands.
                            )
                            ->label('قیمت')
                            ->numeric()
                            ->suffix('تومان')
                            ->rules(['integer', 'min:0'])
                            ->required(),

                        Forms\Components\Select::make('discount_id')
                            ->label("تخفیف")
                            ->relationship('discountItem', 'percent')
                            ->nullable()
                            ->createOptionForm([
                                Forms\Components\Grid::make()
                                    ->schema([
                                        TextInput::make("percent")
                                            ->label("درصد")
                                            ->numeric()
                                            ->maxValue(100)
                                            ->minValue(0)
                                            ->suffix('%')
                                            ->required()
                                            ->default(0),
                                        JalaliDateTimePicker::make("expired_at")
                                            ->required()
                                            ->label("تاریخ انقضا")
                                    ])
                                    ->columns([
                                        'sm' => 2,
                                    ])
                                    ->columnSpan([
                                        'sm' => 2,
                                    ]),
                            ]),

                        JalaliDatePicker::make('published_at')
                            ->default(now())
                            ->label('تاریخ انتشار')
                            ->required(),

                        TextInput::make('inventory')
                            ->label('ظرفیت')
                            ->numeric()
                            ->rules(['integer', 'min:0'])
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

                        SEO::make(),

                        Forms\Components\Placeholder::make('created_at')
                            ->label('ساخته شده :')
                            ->content(fn (?Course $record): string => $record ? $record->created_at->diffForHumans() : '-'),
                        Forms\Components\Placeholder::make('updated_at')
                            ->label('بروزرسانی شده:')
                            ->content(fn (?Course $record): string => $record ? $record->updated_at->diffForHumans() : '-'),
                    ])
                    ->columnSpan(1),
                Repeater::make('common_questions')
                    ->schema([
                        TextInput::make('question')
                            ->label("سوال")
                            ->required(),
                        Textarea::make('answer')
                            ->label("پاسخ")
                            ->cols(10)
                            ->required(),
                    ])
                    // ->relationship()
                    ->orderable("sort")
                    ->label("پرسش متداول")
                    ->columns([
                        'sm' => 1,
                    ])
                    ->columnSpan([
                        'sm' => 2,
                    ]),
                Card::make()
                    ->columnSpan([
                        'sm' => 2,
                    ])
                    ->schema([
                        Repeater::make('attributes')
                            ->schema([
                                TextInput::make('attribute')
                                    ->label("سر فصل ها")
                                    ->required(),
                            ])
                            // ->relationship()
                            ->required()
                            ->label("مبحث")
                            ->columns([
                                'sm' => 1,
                            ])
                            ->columnSpan([
                                'sm' => 2,
                            ]),
                    ])
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
                    ->url(fn (Course $record) => route("course.single", $record))
                    ->sortable(),

                Tables\Columns\TextColumn::make('view')
                    ->label("بازدید")
                    ->sortable(),

                TextColumn::make("price")
                    ->label("قیمت")
                    ->html()
                    ->getStateUsing(function (Course $record) {

                        return $record->discountItem
                            ?  '<del style="color: red;" >' . number_format($record->price) . "</del>  " . number_format($record->discounted_price)
                            : number_format($record->price);
                    }),
                Tables\Columns\TextColumn::make('slug')
                    ->label("نامک")
                    ->searchable()
                    ->sortable(),
                TextColumn::make("inventory")->label("ظرفیت"),

                JalaliDateTimeColumn::make('published_at')->date()->label("منتشر شده"),
                JalaliDateTimeColumn::make('created_at')->date()->label("ساخته شده")
            ])
            ->filters([
                Tables\Filters\Filter::make('published_at')
                    ->form([
                        JalaliDatePicker::make('published_from')
                            ->label(" تاریخ انتشار از ")
                            ->placeholder(fn ($state): string => Jalalian::now()->format("d M, Y")),
                        JalaliDatePicker::make('published_until')
                            ->label("تاریخ انتشار از")
                            ->placeholder(fn ($state): string => Jalalian::now()->format("d M, Y")),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['published_from'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                            )
                            ->when(
                                $data['published_until'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                            );
                    }),
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
            OrdersRelationManager::class,
            CommentsRelationManager::class
        ];
    }

    public static function getGlobalSearchResultTitle(Model $record): string
    {
        return $record->title;
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['title', 'slug', 'user.name', 'price', 'inventory'];
    }

    public static function getGlobalSearchResultDetails(Model $record): array
    {
        return [
            'نویسنده' => $record->user->name,
        ];
    }

    // protected static function getGlobalSearchEloquentQuery(): Builder
    // {
    //     return parent::getGlobalSearchEloquentQuery()->with(['author', 'category']);
    // }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCources::route('/'),
            'create' => Pages\CreateCource::route('/create'),
            'edit' => Pages\EditCource::route('/{record}/edit'),
        ];
    }
}
