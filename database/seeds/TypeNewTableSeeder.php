<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class TypeNewTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $current_date = Carbon::now('Asia/Ho_Chi_Minh');
        DB::table('type_news')->insert([

        ]);
    }
}
