<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ShopTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('shops')->insert([
            'id' => 1,
            'shop_name' => "Shop Demo",
            'address' => "6/82 Duy Tan, Cau Giay, Ha Noi",
            'description' => "Chainos Demo",
            'created_at' => Carbon::create(2019, rand(5, 7) , rand(1, 28), rand(1, 12), rand(1, 59), rand(1, 59)),
            'updated_at' => Carbon::create(2019, rand(5, 7) , rand(1, 28), rand(1, 12), rand(1, 59), rand(1, 59))
        ]);


        DB::table('shops')->insert([
            'id' => 2,
            'shop_name' => "Foglian Coffee",
            'address' => "Số 56 Ngõ 298 Tây Sơn, Ngã Tư Sở, Đống Đa, Hà Nội ",
            'description' => "Coffee Shop ",
            'created_at' => Carbon::create(2019, rand(5, 7) , rand(1, 28), rand(1, 12), rand(1, 59), rand(1, 59)),
            'updated_at' => Carbon::create(2019, rand(5, 7) , rand(1, 28), rand(1, 12), rand(1, 59), rand(1, 59))
        ]);

        DB::table('shops')->insert([
            'id' => 3,
            'shop_name' => "Shop Shoes",
            'address' => "6/82 Duy Tan, Cau Giay, Ha Noi",
            'description' => "Chainos Demo Licenses",
            'created_at' => Carbon::create(2019, rand(5, 7) , rand(1, 28), rand(1, 12), rand(1, 59), rand(1, 59)),
            'updated_at' => Carbon::create(2019, rand(5, 7) , rand(1, 28), rand(1, 12), rand(1, 59), rand(1, 59))
        ]);

        DB::table('user_shops')->insert([
            'user_id' => 1,
            'shop_id' => 1,
        ]);

        DB::table('user_shops')->insert([
            'user_id' => 1,
            'shop_id' => 2,
        ]);

        DB::table('user_shops')->insert([
            'user_id' => 1,
            'shop_id' => 3,
        ]);
    }
}
