<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $current_date = Carbon::now('Asia/Ho_Chi_Minh');
        DB::table('categorys')->insert([
            'Name' => 'Xa Hoi',
            'Unmarker_name' => 'Xa-Hoi',
            'created_at' => $current_date,
            'updated_at' => $current_date,
        ]);
        DB::table('categorys')->insert([
            'Name' => 'The Gioi',
            'Unmarker_name' => 'The-Gioi',
            'created_at' => $current_date,
            'updated_at' => $current_date,
        ]);

        DB::table('categorys')->insert([
            'Name' => 'Kinh Doanh',
            'Unmarker_name' => 'Kinh-Doanh',
            'created_at' => $current_date,
            'updated_at' => $current_date,
        ]);
        DB::table('categorys')->insert([
            'Name' => 'Van Hoa',
            'Unmarker_name' => 'Van-Hoa',
            'created_at' => $current_date,
            'updated_at' => $current_date,
        ]);
        DB::table('categorys')->insert([
            'Name' => 'The Thao',
            'Unmarker_name' => 'The-Thao',
            'created_at' => $current_date,
            'updated_at' => $current_date,
        ]);

        DB::table('categorys')->insert([
            'Name' => 'Phap Luat',
            'Unmarker_name' => 'Phap-Luat',
            'created_at' => $current_date,
            'updated_at' => $current_date,
        ]);
        DB::table('categorys')->insert([
            'Name' => 'Doi Song',
            'Unmarker_name' => 'Doi-Song',
            'created_at' => $current_date,
            'updated_at' => $current_date,
        ]);



    }
}
