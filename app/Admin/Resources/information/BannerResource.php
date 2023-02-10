<?php

namespace App\Admin\Resources\Information;

use App\Admin\Resources\Information\BannerResource\Pages;
use App\Admin\Resources\Information\BannerResource\RelationManagers;
use Modules\Blog\Entities\Category;
use Modules\Blog\Entities\Post;
use Closure;
use Modules\Shop\Entities\Category as ShopCategory;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\MorphToSelect;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Select;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Support\HtmlString;
use Modules\Blog\Entities\Category as EntitiesCategory;
use Modules\Blog\Entities\Post as EntitiesPost;
use Modules\Information\Entities\Banner;
use Modules\Information\Entities\Page;
use Modules\Shop\Entities\Product;

class BannerResource extends Resource
{
    protected static ?string $model = Banner::class;

    protected static ?string $navigationIcon = 'heroicon-o-home';

    protected static ?string $navigationGroup = 'تنظیمات';

    protected static array $bannerRatio = [
        'carousel' => ['width' => "950", "height" => "495"],
        'small-banner' => ['width' => "300", "height" => "495"],
        'medium-banner' => ['width' => "630", "height" => "220"],
        'categories-banner' =>  ['width' => "80", "height" => "80"],
        'info-banner' => ['width' => "80", "height" => "80"]
    ];


    public static function getModelLabel(): string
    {
        return "بنر";
    }

    public static function getPluralModelLabel(): string
    {
        return "بنر ها";
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('نام بنر')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('alt')
                            ->label('توضیحات بنر')
                            ->hint('*سئو*')
                            ->hintColor('danger')
                            ->maxLength(255),

                        Select::make('collection')
                            ->required()
                            ->reactive()
                            ->label('نوع بنر ( محل قرار گیری )')
                            ->default('carousel')
                            ->options([
                                'carousel' => 'بنر کروسل',
                                'small-banner' => 'بنر کوچک',
                                'medium-banner' => 'بنر های متوسط',
                                'categories-banner' =>  'بنر دسته بندی',
                                'info-banner' => 'بنر اطلاعات'
                            ]),

                        Placeholder::make('توجه:')
                            ->reactive()
                            ->hidden(fn (Closure $get) => !($get('collection') == 'small-banner' and Banner::where('collection', 'small-banner')->count() > 0))
                            ->content(new HtmlString("<p style='color:red;'>
                                قابل توجه شما قبلا یک بنر کوچک ایجاد شده است با ایجاد این بنر ، بنر قبلی دیگر نمایش داده نمی شود .
                                </p>")),

                        MorphToSelect::make('bannerable')
                            ->reactive()
                            ->required(fn (Closure $get) => $get('collection') == 'categories-banner')
                            ->preload()
                            ->label(fn (Closure $get) => $get('collection') == 'categories-banner' ?
                                'لینک دسته بندی محصول یا خود محصول' :
                                'لینک به صفحه ی مورد نظر')
                            ->searchable()
                            ->types(fn (Closure $get) => static::bannerType($get('collection'))),

                        FileUpload::make('path')
                            ->reactive()
                            ->hint(fn (Closure $get) => " سایز استاندارد " . self::$bannerRatio[$get('collection')]['width'] . " * " . self::$bannerRatio[$get('collection')]['height'] . " px ")
                            ->imageResizeTargetWidth(fn (Closure $get) =>  self::$bannerRatio[$get('collection')]['width'])
                            ->imageResizeTargetHeight(fn (Closure $get) =>  self::$bannerRatio[$get('collection')]['height'])
                            ->label('عکس بنر')
                            ->required(),
                    ])
            ]);
    }

    public static function bannerType($collection)
    {
        if ($collection == 'categories-banner') {
            return [
                MorphToSelect\Type::make(ShopCategory::class)
                    ->label('دسته بندی محصول')
                    ->titleColumnName('name')
                    ->getOptionLabelFromRecordUsing(fn (ShopCategory $record): string => "{$record->name}  ----  {$record->slug}"),
            ];
        } else
            return [
                MorphToSelect\Type::make(Page::class)
                    ->label('صفحه')
                    ->titleColumnName('name')
                    ->getOptionLabelFromRecordUsing(fn (Page $record): string => "{$record->name}  ----  {$record->slug}"),

                MorphToSelect\Type::make(Product::class)
                    ->label('محصول')
                    ->titleColumnName('name')
                    ->getOptionLabelFromRecordUsing(fn (Product $record): string => "{$record->name}  ----  {$record->slug}"),

                MorphToSelect\Type::make(ShopCategory::class)
                    ->label('دسته بندی محصول')
                    ->titleColumnName('name')
                    ->getOptionLabelFromRecordUsing(fn (ShopCategory $record): string => "{$record->name}  ----  {$record->slug}"),

                MorphToSelect\Type::make(Post::class)
                    ->getOptionLabelFromRecordUsing(fn (EntitiesPost $record): string => "{$record->title}  ----  {$record->slug}")
                    ->label('مقالات')
                    ->titleColumnName('title'),

                MorphToSelect\Type::make(Category::class)
                    ->getOptionLabelFromRecordUsing(fn (EntitiesCategory $record): string => "{$record->name}  ----  {$record->slug}")
                    ->label('دسته بندی مقالات')
                    ->titleColumnName('name')
            ];
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('نام بنر'),
                TextColumn::make('collection')->enum([
                    'carousel' => 'بنر کروسل',
                    'small-banner' => 'بنر کوچک',
                    'medium-banner' => 'بنر های متوسط',
                    'categories-banner' =>  'بنر دسته بندی',
                    'info-banner' => 'بنر اطلاعات'
                ])
                    ->label('محل قرار گیری'),
                Tables\Columns\TextColumn::make('alt')
                    ->label('توضیحات بنر(سئو)'),
                ImageColumn::make('path')
                    ->label("عکس بنر"),
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
            'index' => Pages\ListBanners::route('/'),
            'create' => Pages\CreateBanner::route('/create'),
            'edit' => Pages\EditBanner::route('/{record}/edit'),
        ];
    }
}
