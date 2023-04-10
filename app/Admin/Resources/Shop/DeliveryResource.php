<?php

namespace App\Admin\Resources\Shop;

use App\Admin\Resources\Shop\DeliveryResource\Pages;
use App\Admin\Resources\Shop\DeliveryResource\RelationManagers;
use App\Models\Shop\Delivery;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TextInput\Mask;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Modules\Payment\Entities\Delivery as EntitiesDelivery;

class DeliveryResource extends Resource
{
    protected static ?string $model = EntitiesDelivery::class;

    protected static ?string $slug = 'shop/delivery';

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $navigationGroup = 'فروشگاه';

    protected static ?string $navigationIcon = 'heroicon-o-truck';

    protected static ?int $navigationSort = 6;

    protected static ?string $inverseRelationship = 'section';

    public static function getModelLabel(): string
    {
        return "حمل و نقل";
    }

    public static function getPluralModelLabel(): string
    {
        return "حمل و نقل";
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()
                    ->schema([
                        TextInput::make('name')
                            ->required()
                            ->label('عنوان'),
                        TextInput::make('take_time')
                            ->required()
                            ->label('زمان تحویل')
                            ->placeholder('مثلا: 2 الی 3 روز کاری'),
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
                        TextInput::make('free_con')
                            ->mask(
                                fn (Mask $mask) => $mask
                                    ->numeric()
                                    ->thousandsSeparator(','), // Add a separator for thousands.
                            )
                            ->label('حداقل قیمت برای حمل رایگان')
                            ->numeric()
                            ->suffix('تومان')
                            ->rules(['integer', 'min:0'])
                            ->required(),
                        Toggle::make('status')
                            ->label('فعال / غیر فعال'),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->label('نام'),
                Tables\Columns\TextColumn::make('price')
                    ->searchable()
                    ->label('قیمت (تومان)')
                    ->formatStateUsing(fn (string $state): string => number_format($state)),
                Tables\Columns\TextColumn::make('take_time')
                    ->sortable()
                    ->searchable()
                    ->label('زمان ارسال'),
                IconColumn::make('status')
                    ->label('فعال')
                    ->sortable(),
                Tables\Columns\TextColumn::make('free_con')
                    ->searchable()
                    ->label('حداقل مقدار برای حمل رایگان')
                    ->formatStateUsing(fn ($state) => is_null($state) ? '' : number_format($state)),
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
            'index' => Pages\ListDeliveries::route('/'),
            'create' => Pages\CreateDelivery::route('/create'),
            'edit' => Pages\EditDelivery::route('/{record}/edit'),
        ];
    }
}
