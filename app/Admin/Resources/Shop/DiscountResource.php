<?php

namespace App\Admin\Resources\Shop;

use App\Admin\Resources\Shop\DiscountResource\Pages;
use App\Admin\Resources\Shop\DiscountResource\RelationManagers;
use Ariaieboy\FilamentJalaliDatetime\JalaliDateTimeColumn;
use Ariaieboy\FilamentJalaliDatetimepicker\Forms\Components\JalaliDateTimePicker;
use Carbon\Carbon;
use Closure;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\MorphToSelect;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TextInput\Mask;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Wizard;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\Layout\Grid;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Modules\Payment\Entities\Discount;

class DiscountResource extends Resource
{
    protected static ?string $model = Discount::class;

    protected static ?string $recordTitleAttribute = 'code';

    protected static ?string $navigationGroup = 'تخفیف %';

    protected static ?string $navigationIcon = 'heroicon-o-gift';

    public static function getModelLabel(): string
    {
        return "کد تخفیف";
    }

    public static function getPluralModelLabel(): string
    {
        return "کدهای تخفیف";
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
                    // Wizard\Step::make('مقدار تخفیف')

                    //     ->schema([
                    //         Forms\Components\Card::make()
                    //             ->schema(
                    //                 static::valueForm()
                    //             )
                    //     ]),
                    Wizard\Step::make('محدودیت استفاده')
                        ->schema([
                            Card::make()
                                ->schema(static::limitForm())
                        ]),
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
                        Tabs\Tab::make('محدودیت استفاده')
                            ->schema(static::limitForm()),
                    ])
                    ->columnSpan([
                        'sm' => 2,
                    ])
                    ->disabledOn("create")
                    ->hiddenOn("create"),
            ])
            ->columns([
                'sm' => 2,
                'lg' => null,
            ]);
    }

    public static function informationForm()
    {
        return [
            TextInput::make("code")
                ->label("کد تخفیف")
                ->required(),
            JalaliDateTimePicker::make("expired_at")
                ->required()
                ->default(Carbon::now())
                ->label("تاریخ انقضا"),

            TextInput::make('min_order_value')
                ->mask(
                    fn (Mask $mask) => $mask
                        ->numeric()
                        ->thousandsSeparator(','), // Add a separator for thousands.
                )
                ->label('حداقل هزینه اعمال کد تخفیف')
                ->numeric()
                ->placeholder("هیچ حداقلی وجود ندارد")
                ->suffix('تومان')
                ->rules(['integer', 'min:0'])
                ->nullable(),
            Hidden::make("exception_product_category_id")
                ->default(1),

        ];
    }

    protected static function valueForm()
    {
        return [
            Select::make("type")
                ->label("نحوه تخفیف")
                ->options([
                    'value_pre_product' => "تخفیف درصدی هر محصول",
                    "value" => "تخفیف ثابت کل سبد خرید ",
                    "percent" => "تخفیف درصدی کل سبد خرید"
                ])
                ->default("percent")
                ->required()
                ->reactive(),

            TextInput::make('discount_value')
                ->mask(
                    fn (Mask $mask) =>
                    $mask
                        ->numeric()
                        ->thousandsSeparator(',')
                )
                ->label(fn (Closure $get) => $get("type") !== 'value' ? "مقدار تخفیف" : "درصد تخفیف")
                ->numeric()
                ->suffix(fn (Closure $get) => $get("type") == 'value' ? "تومان" : "درصد %")
                ->maxValue(fn (Closure $get) => $get("type") !== 'value' ? null : 100)
                ->minValue(fn (Closure $get) => $get("type") == 'value' ? 10000 : 0)
                ->rules(['integer'])
                ->required(),
            Toggle::make('is_delivery_free')
                ->label("اجازه حمل و نقل رایگان")
                ->helperText("اگر کد تخفیف شامل ارسال رایگان است این گزینه را علامت بزنید")
                ->inline(true),
        ];
    }

    protected static function limitForm()
    {
        return [
            Select::make("type")
                ->label("نحوه تخفیف")
                ->options([
                    // 'value_pre_product' => "تخفیف درصدی هر محصول",
                    "value" => "تخفیف ثابت کل سبد خرید ",
                    "percent" => "تخفیف درصدی کل سبد خرید"
                ])
                ->default("percent")
                ->required()
                ->reactive(),

            TextInput::make('discount_value')
                ->mask(
                    fn (Mask $mask) =>
                    $mask
                        ->numeric()
                        ->thousandsSeparator(',')
                )
                ->label(fn (Closure $get) => $get("type") !== 'value' ? "درصد تخفیف" : "مقدار تخفیف")
                ->numeric()
                ->suffix(fn (Closure $get) => $get("type") == 'value' ? "تومان" : "درصد %")
                ->maxValue(fn (Closure $get) => $get("type") !== 'value' ? 100 : null)
                ->minValue(fn (Closure $get) => $get("type") == 'value' ? 10000 : 0)
                ->rules(['integer'])
                ->required(),

            // Placeholder::make('توضیحات')
            //     ->hidden(fn (Closure $get) => $get('type') !== 'value_pre_product')
            //     ->content('در صورت وارد نکردن هیچ کدام از موارد زیر کد تخفیف روی همه ی موارد سبد خرید اجرا میشود.'),

            // Section::make("محدودیت محصولات")
            //     ->schema([
            //         Select::make('shop_category')
            //             ->multiple()
            //             ->label("دسته بندی ها")
            //             ->preload()
            //             ->relationship('discountCategories', 'name'),

            //         Select::make('products')
            //             ->multiple()
            //             ->label("محصولات")
            //             ->preload()
            //             ->relationship('discountProducts', 'name'),

            //         Select::make('course')
            //             ->multiple()
            //             ->label("دوره ها")
            //             ->preload()
            //             ->relationship('discountCourses', 'title'),
            //     ])
            //     ->hidden(fn (Closure $get) => $get('type') !== 'value_pre_product'),
            Section::make('محدودیت کاربران')
                ->schema([
                    // Select::make('discountUser')
                    //     ->getOptionLabelFromRecordUsing(fn (Model $record) => "{$record->name} _ {$record->email}")
                    //     // ->hidden(fn (Closure $get) => $get('type') !== 'value_pre_product')
                    //     ->multiple()
                    //     ->label("کاربرانی که قبلا ثبت نام کرده اند")
                    //     ->preload()
                    //     ->relationship('discountUsers', 'name'),

                    // TagsInput::make('mobiles')
                    //     // ->hidden(fn (Closure $get) => $get('type') !== 'value_pre_product')
                    //     ->label('شماره موبایل های مجاز'),


                    TextInput::make('limit_on_use')
                        ->label('محدودیت استفاده کد تخفیف')
                        ->placeholder('استفاده نامحدود')
                        ->numeric()
                        ->minValue(0),

                    // TextInput::make('limit_of_user_use')
                    //     ->label('محدودیت استفاده کد تخفیف به ازای هر کاربر')
                    //     ->placeholder('استفاده نامحدود')
                    //     ->numeric()
                    //     ->minValue(0),
                ]),



            // MorphToSelect::make("discountable")
            //     ->types([
            //         MorphToSelect\Type::make(Product::class)->titleColumnName('name')
            //             ->label("محصولات"),
            //         MorphToSelect\Type::make(Course::class)->titleColumnName('title')
            //             ->label('دوره ها'),
            //     ])

            //     ->searchable()
            //     ->preload()
        ];
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make("code")
                    ->label("کد تخفیف")
                    ->searchable(),
                TextColumn::make("percent")
                    ->label("درصد")
                    ->sortable(),
                JalaliDateTimeColumn::make('expired_at')
                    ->dateTime()
                    ->label('تاریخ انقضا')
                    ->sortable()
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
            'index' => Pages\ListDiscounts::route('/'),
            'create' => Pages\CreateDiscount::route('/create'),
            'edit' => Pages\EditDiscount::route('/{record}/edit'),
        ];
    }
}
