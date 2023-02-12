<?php

namespace App\Admin\Widgets;

use App\Models\Comment;
use BezhanSalleh\FilamentShield\Traits\HasWidgetShield;
use Closure;
use Filament\Tables;
use Filament\Tables\Columns\BooleanColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;

class LatestCommetn extends BaseWidget
{
    use HasWidgetShield;

    protected static ?int $sort = 2;

    protected static ?string $heading = "اخرین دیدگاه ها ";


    protected function getTableQuery(): Builder
    {
        return Comment::query()->latest();
    }

    protected function getTableColumns(): array
    {
        return [
            TextColumn::make('content')
                ->label("دیدگاه")
                ->searchable(),
            TextColumn::make('child.content')
                ->label("پاسخ کاربران")
                ->searchable(),
            TextColumn::make("user.name")->label('کاربر'),
            BooleanColumn::make("is_visible")->label('قابل مشاهده')->sortable(),
        ];
    }
}
