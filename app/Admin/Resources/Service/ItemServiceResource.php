<?php

namespace App\Admin\Resources\Service;

use App\Admin\Resources\Service\ItemServiceResource\Pages;
use Modules\Service\Entities\ServiceItem;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;


class ItemServiceResource extends Resource
{
    protected static ?string $model = ServiceItem::class;

    protected static ?string $navigationIcon = 'heroicon-o-tag';

    protected static ?string $slug = 'service/items';

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $navigationGroup = 'خدمات';

    protected static ?int $navigationSort = 0;

    protected static ?string $inverseRelationship = 'section';

    public static function getModelLabel(): string
    {
        return "آیتم خدمات";
    }

    public static function getPluralModelLabel(): string
    {
        return "آیتم های خدمات";
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make("name")->label("عنوان خدمات")
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make("name")->label("عنوان خدمات")
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
            'index' => Pages\ListItemServices::route('/'),
            'create' => Pages\CreateItemService::route('/create'),
            'edit' => Pages\EditItemService::route('/{record}/edit'),
        ];
    }
}
