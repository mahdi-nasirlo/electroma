<?php

namespace App\Filament\Resources\Shop\ProductResource\RelationManagers;

use App\Models\Shop\Attribute;
use Closure;
use Filament\Forms;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Actions\AttachAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TagsColumn;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AttributesRelationManager extends RelationManager
{
    protected static string $relationship = 'attributes';

    protected static ?string $recordTitleAttribute = 'name';

    public static function getModelLabel(): string
    {
        return "شاخص";
    }

    public static function getPluralModelLabel(): string
    {
        return "مشخصات";
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label('نام شاخص')
                    ->required()
                    ->unique(ignoreRecord: true),

                Select::make('type')
                    ->required()
                    ->reactive()
                    ->afterStateUpdated(function (Closure $set, $state) {
                        if ($state == 'boolean')
                            $set('values', ["ندارد", "دارد"]);
                        else {
                            $set('values', []);
                        }
                    })
                    ->label('نوع داده')
                    ->default('string')
                    ->options([
                        'string' => "متن",
                        'boolean' => 'دارد یا ندارد'
                    ]),

                TagsInput::make('values')
                    ->label('مقادیر')
                    ->reactive()
                    ->required()
                    ->hidden(fn (Closure $get) => $get('type') !== 'string'),

                Select::make('value')
                    ->hidden(fn (Closure $get) => $get('type') == null)
                    ->label('مقدار مربوط به محصول')
                    ->options(function (Closure $get) {
                        if ($get('type') ==  'boolean') {
                            return [
                                'ندارد' => "ندارد",
                                'دارد' => 'دارد'
                            ];
                        }

                        return array_combine($get('values'), $get('values'));
                    })
                    ->required(),

                Checkbox::make('is_searchable')
                    ->label('در فیلتر کردن محصولات این شاخص لحاظ شود ؟')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('نام'),
                TextColumn::make('AttributeGroup.name')
                    ->label('دسته بندی'),
                IconColumn::make('is_searchable')
                    ->boolean()
                    ->label('ایجاد فیلتر'),
                // add toggle column to is searchable
                TagsColumn::make('values')
                    ->label('مقادیر')
                    ->default(['دارد', 'ندارد']),
                TextColumn::make('value')
                    ->label('مقدار مربوط به محصول')
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
                Tables\Actions\AttachAction::make()
                    ->preloadRecordSelect()
                    ->form(fn (AttachAction $action): array => [
                        $action->getRecordSelect()
                            ->reactive(),
                        Hidden::make('category_id')
                            ->default(function (RelationManager $livewire) {
                                return $livewire->ownerRecord->category_id;
                            }),
                        Select::make('value')
                            ->required()
                            ->label('مقدار مربوط به محصول')
                            ->options(function (Closure $get) {
                                $attributes = Attribute::find($get('recordId'))->values;

                                return $attributes ? array_combine($attributes, $attributes) : ['دارد' => 'دارد', 'ندارد' => 'ندارد'];
                            })
                            ->hidden(fn (Closure $get) => $get('recordId') === null)
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DetachAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DetachBulkAction::make(),
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
}
