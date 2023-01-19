<?php

namespace App\Filament\Resources\Shop;

use App\Filament\Resources\Shop\ProductResource\RelationManagers\CommentsRelationManager;
use App\Filament\Resources\Shop\ProductResource\Pages;
use App\Filament\Resources\Shop\ProductResource\RelationManagers;
use App\Filament\Resources\Shop\ProductResource\RelationManagers\AttributesRelationManager;
use Ariaieboy\FilamentJalaliDatetimepicker\Forms\Components\JalaliDateTimePicker;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TextInput\Mask;
use Filament\Forms\Components\Wizard;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationGroup;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Modules\Shop\Entities\Category;
use Modules\Shop\Entities\Product;
use Mohamedsabil83\FilamentFormsTinyeditor\Components\TinyEditor;
use RalphJSmit\Filament\SEO\SEO;

// FIXME fix create category  
// TODO: add product discount  

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $slug = 'shop/products';

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $navigationGroup = 'فروشگاه';

    protected static ?string $navigationIcon = 'heroicon-o-shopping-cart';

    protected static ?int $navigationSort = 2;

    protected static ?string $inverseRelationship = 'section';

    public static function getModelLabel(): string
    {
        return "محصول";
    }

    public static function getPluralModelLabel(): string
    {
        return "محصولات";
    }

    public static function form(Form $form): Form
    {

        return $form
            ->schema([
                Wizard::make([
                    Wizard\Step::make('اطلاعات اولیه')
                        ->schema([
                            Forms\Components\Card::make()
                                ->schema(
                                    static::informationForm()
                                )
                        ]),
                    Wizard\Step::make('تصاویر')
                        ->schema([
                            Section::make("تصاویر کاور")
                                ->schema(static::mediaForm())
                        ]),
                    Wizard\Step::make('محتوا')
                        ->schema(static::contentForm()),
                ])
                    ->columnSpan([
                        'sm' => 2,
                    ])
                    ->disabledOn("edit")
                    ->hiddenOn("edit"),


                Tabs::make('Heading')
                    ->tabs([
                        Tabs\Tab::make('اطلاعات اولیه')
                            ->schema(static::informationForm()),
                        Tabs\Tab::make('تصاویر')
                            ->schema(static::mediaForm()),
                        Tabs\Tab::make('محتوا')
                            ->schema([
                                Card::make()
                                    ->schema(static::contentForm())
                            ]),
                    ])
                    ->columnSpan([
                        'sm' => 2,
                    ])
                    ->disabledOn("create")
                    ->hiddenOn("create"),
                Forms\Components\Card::make()
                    ->schema([
                        SEO::make(),
                    ])
                    ->columnSpan(1),
            ])
            ->columns([
                'sm' => 3,
                'lg' => null,
            ]);
    }

    public static function informationForm()
    {
        return [
            Forms\Components\TextInput::make('name')
                ->label('عنوان')
                ->autocomplete("off")
                ->maxLength(255)
                ->required()
                ->reactive()
                ->afterStateUpdated(fn ($state, callable $set) => $set('slug', SlugService::createSlug(Product::class, 'slug', $state == null ? "" : $state))),
            Forms\Components\TextInput::make('slug')
                ->label('نامک')
                ->disabled()
                ->required()
                ->unique(Product::class, 'slug', fn ($record) => $record),
            TextInput::make('inventory')
                ->label('موجودی')
                ->numeric()
                ->rules(['integer', 'min:0'])
                ->required(),
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
            // Forms\Components\Select::make('discount_id')
            //     ->label("تخفیف")
            //     ->relationship('discountItem', 'percent')
            //     ->nullable()
            //     ->createOptionForm([
            //         Forms\Components\Grid::make()
            //             ->schema([
            //                 TextInput::make("percent")
            //                     ->label("درصد")
            //                     ->numeric()
            //                     ->maxValue(100)
            //                     ->minValue(0)
            //                     ->suffix('%')
            //                     ->required()
            //                     ->default(0),
            //                 JalaliDateTimePicker::make("expired_at")
            //                     ->required()
            //                     ->label("تاریخ انقضا")
            //             ])
            //             ->columns([
            //                 'sm' => 2,
            //             ])
            //             ->columnSpan([
            //                 'sm' => 2,
            //             ]),
            //     ]),
            Select::make('category_id')
                ->label('دسته بندی')
                ->required()
                ->searchable()
                ->preload()
                ->relationship('category', 'name')
                ->createOptionForm([
                    Forms\Components\Grid::make()
                        ->schema([
                            Forms\Components\TextInput::make('name')
                                ->label('عنوان')
                                ->required()
                                ->reactive()
                                ->afterStateUpdated(fn ($state, callable $set) => $set('slug', SlugService::createSlug(category::class, 'slug', $state == null ? "" : $state))),
                            Forms\Components\TextInput::make('slug')
                                ->label('نامک')
                                ->disabled()
                                ->required()
                                ->unique(category::class, 'slug', fn ($record) => $record),
                        ]),
                    Forms\Components\Select::make('parent_id')
                        ->preload()
                        ->searchable()
                        ->label('دسته بندی پدر')
                        ->relationship('parent', 'name', fn (Builder $query, ?Category $record) => $query->whereNot('id', $record ? $record->id : null)),
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
                    //         // Forms\Components\TextInput::make('name')
                    //         //     ->required()
                    //         //     ->maxLength(255),
                    //         // Hidden::make('slug')->default("laskjdflk" . rand(0, 1000000)),
                    //         // Forms\Components\Textarea::make('desc')
                    //         //     ->maxLength(65535),
                    //         // Select::make('type')
                    //         //     ->options([
                    //         //         'api' => 'api',
                    //         //         'web' => 'web',
                    //         //         'blog' => 'blog'
                    //         //     ]),
                    //         // TextInput::make('level')->default(0),
                    //         // Forms\Components\Select::make('parent_id')
                    //         //     ->label('دسته بندی پدر')
                    //         //     ->reactive()
                    //         //     ->afterStateUpdated(function (Closure $set, $state) {
                    //         //         if ($state) {
                    //         //             $level = Category::find($state)->level;
                    //         //             $set('level', $level + 1);
                    //         //         } else
                    //         //             $set('level', 0);
                    //         //     })
                    //         //     ->relationship('parent', 'name', fn (Builder $query, ?Category $record) => $query->whereNot('id', $record ? $record->id : null)),
                    //         // Forms\Components\Toggle::make('is_visible'),
                    //         // // IconPicker::make('icon'),
                    //         // Forms\Components\Textarea::make('shortInfo')
                    //         //     ->maxLength(65535),
                    //         // Forms\Components\TextInput::make('cover')
                    //         //     ->maxLength(255),
                ]),
        ];
    }

    public static function mediaForm()
    {
        return [
            FileUpload::make("cover")
                ->image()
                ->imageCropAspectRatio("1:1")
                ->maxSize(800)
                ->label('عکس شاخص'),
            FileUpload::make('cover_hover')
                ->imageCropAspectRatio("1:1")
                ->image()
                ->imageCropAspectRatio("1:1")
                ->maxSize(800)
                ->label("عکس شاخص دوم")
                ->helperText("می توانید از دو عکس شاخص برای نمایش محصول از دو زاویه استفاده کنید"),
            SpatieMediaLibraryFileUpload::make('gallery')
                ->imageCropAspectRatio("1:1")
                ->label("گالری تصاویر")
                ->collection("product.gallery")
                ->multiple()
                ->enableReordering()
        ];
    }

    public static function contentForm()
    {
        return [
            Card::make()
                ->schema([
                    Repeater::make("short_information")
                        ->schema([
                            TextInput::make("name")
                                ->required()
                                ->label("عنوان")
                        ])
                        ->defaultItems(0)
                        ->label("ویژگی ها")
                        ->helperText("مثلا : گارانتی 12 ماهه"),
                    Textarea::make('short_desc')
                        ->label('توضیحات کوتاه'),
                    TinyEditor::make('content')
                        ->required()
                        ->label('توضیحات')
                ])
        ];
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('cover')
                    ->label('عکس شاخص'),
                Tables\Columns\TextColumn::make('name')
                    ->label('نام محصول')
                    ->sortable()
                    ->url(fn (Product $record) => route("shop.product.single", $record))
                    ->searchable(),
                Tables\Columns\TextColumn::make('slug'),
                Tables\Columns\TextColumn::make('gallery'),
                Tables\Columns\TextColumn::make('cover'),
                Tables\Columns\TextColumn::make('price'),
                Tables\Columns\TextColumn::make('inventory'),
                Tables\Columns\TextColumn::make('published_at')
                    ->dateTime(),
                Tables\Columns\TextColumn::make('content'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime(),
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
            RelationGroup::make('ویژگی ها', [
                AttributesRelationManager::class,
            ]),
            RelationGroup::make('کامنت ها', [
                CommentsRelationManager::class
            ]),
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
