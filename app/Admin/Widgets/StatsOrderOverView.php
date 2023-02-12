<?php

namespace App\Admin\Widgets;

use App\Models\User;
use BezhanSalleh\FilamentShield\Traits\HasWidgetShield;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;
use Modules\Blog\Entities\Post;
use Modules\Course\Entities\Course;
use Modules\Payment\Entities\Order;

class StatsOrderOverView extends BaseWidget
{
    use HasWidgetShield;

    protected static ?string $heading = "آمار کلی";


    protected function getCards(): array
    {
        return [
            Card::make('درامد کل', $this->totalIncome()),
            Card::make('تعداد کاربران', User::count()),
            Card::make('بازدید مقالات + دوره ها', $this->totalView())
        ];
    }

    protected function totalIncome()
    {
        return  number_format(Order::all(["status", "price"])->where("status", "!=", "unpaid")->sum("price"));
    }

    protected function totalView()
    {
        $article = Post::all(["view"])->sum("view");
        $course = Course::all(["view"])->sum("view");

        return $article + $course;
    }
}
