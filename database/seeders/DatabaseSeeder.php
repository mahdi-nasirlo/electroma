<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        DB::table('infographics')->insert(
            [
                [
                    "display_name" => "تلفن همراه واتس اپ دار",
                    "name" => "whatsapp_mobile",
                    "desc" => "",
                    "content" => ""
                ],
                [
                    "display_name" => "توضیحات مربوط به سئو",
                    "name" => "seo_default_desc",
                    "desc" => "این توضیحات برای زمانی در نظر گرفته میشود که توضیحاتی لطاظ نشده باشد",
                    "content" => ""
                ],
                [
                    'display_name' => "شماره موبایل پشتیبانی ( بالای منو )",
                    "name" => "mobile_support",
                    'desc' => "",
                    "content" => "09127165398",
                ],
                [
                    'display_name' => "شماره تفلن پشتیبانی ( بالای منو )",
                    "name" => "phone_support",
                    'desc' => "",
                    "content" => "021-66303530",
                ],
                [
                    'display_name' => "(بالای منو) نشانی",
                    "name" => "location",
                    'desc' => "در این قسمت میتوانید لینک نشانی دفتر خود را از طریق google map در این قسمت کپی کنید . \n <strong><a href='https://www.shabakeh-mag.com/information-feature/9153/%DA%86%DA%AF%D9%88%D9%86%D9%87-%D8%A8%D8%A7-%DA%AF%D9%88%DA%AF%D9%84%E2%80%8C%D9%85%D9%BE-%D9%85%D9%88%D9%82%D8%B9%DB%8C%D8%AA-%D9%85%DA%A9%D8%A7%D9%86%DB%8C-%D8%AE%D9%88%D8%AF-%D8%B1%D8%A7-%D8%A8%D8%B1%D8%A7%DB%8C-%D8%AF%DB%8C%DA%AF%D8%B1%D8%A7%D9%86-%D8%A8%D9%81%D8%B1%D8%B3%D8%AA%DB%8C%D9%85%D8%9F'></strong>برای ایجاد لینک لوکیشن خود می توانید از این لینک استفاده کنید.</a>",
                    "content" => "",
                ],
                [
                    'display_name' => "نشانی دفتر برق کارشو به صورت متن",
                    "name" => "location_text",
                    'desc' => '',
                    "content" => "",
                ],
                [
                    'display_name' => "توضیحات کوتاه زیر عنوان در صفحه خانه",
                    "name" => "index_short_desc",
                    'desc' => '',
                    "content" => "",
                ],
                [
                    'display_name' => "توضیح کوتاه در صفحه اول ( تعمیرات تخصصی )",
                    "name" => "index_section_2_1",
                    'desc' => "",
                    "content" => "",
                ],
                [
                    'display_name' => "توضیح کوتاه در صفحه اول ( آموزش برق ساختمان )",
                    "name" => "index_section_2_2",
                    'desc' => "",
                    "content" => "",
                ],
                [
                    'display_name' => "توضیحات صفحه اول خدمات رسانی برق کارشو ( قسمت جک درب پارکینگی )",
                    "name" => "index_section_3_1",
                    'desc' => "",
                    "content" => "",
                ],
                [
                    'display_name' => "توضیحات صفحه اول خدمات رسانی برق کارشو ( قسمت جک دوربین مداربسته )",
                    "name" => "index_section_3_2",
                    'desc' => "",
                    "content" => "",
                ],
                [
                    'display_name' => "توضیحات صفحه اول خدمات رسانی برق کارشو ( قسمت جک دزدگیر و اماکن )",
                    "name" => "index_section_3_3",
                    'desc' => "",
                    "content" => "",
                ],
                [
                    'display_name' => "توضیحات صفحه اول خدمات رسانی برق کارشو ( قسمت جک درب بارکن تصویری )",
                    "name" => "index_section_3_4",
                    'desc' => "",
                    "content" => "",
                ],
                [
                    'display_name' => "هدف و چشم انداز برق کارشو",
                    "name" => "footer_gooal",
                    'desc' => "",
                    "content" => "",
                ],
                [
                    'display_name' => "لینک اینستاگرام",
                    "name" => "instagram_link",
                    'desc' => "",
                    "content" => "",
                ],
                [
                    'display_name' => "لینک تلگرام",
                    "name" => "telegram_link",
                    'desc' => "",
                    "content" => "",
                ],
                [
                    'display_name' => "لینک لینک دین",
                    "name" => "linkdin_link",
                    'desc' => "",
                    "content" => "",
                ],
            ]
        );
    }
}
