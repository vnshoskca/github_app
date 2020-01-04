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
        DB::table('category')->insert([
            [
                'name' => 'Programming',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'delete_flg' => false,
            ],
            [
                'name' => 'Music',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'delete_flg' => false,
            ],
            [
                'name' => 'Sports',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'delete_flg' => false,
            ],
            [
                'name' => 'Business',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'delete_flg' => false,
            ],
            [
                'name' => 'Money',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'delete_flg' => false,
            ],
            [
                'name' => 'Language',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'delete_flg' => false,
            ],
            [
                'name' => 'Art',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'delete_flg' => false,
            ],
            [
                'name' => 'Science',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'delete_flg' => false,
            ],
            [
                'name' => 'Other',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'delete_flg' => false,
            ],
        ]);
    }
}
