<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'oo',
                'email' => 'o@example.com',
                'password' => bcrypt('password'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'image' => null,
                'introduction' => null,
            ],
            [
                'name' => 'pp',
                'email' => 'p@example.com',
                'password' => bcrypt('password'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'image' => null,
                'introduction' => null,
            ],
            [
                'name' => 'qq',
                'email' => 'q@example.com',
                'password' => bcrypt('password'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'image' => null,
                'introduction' => null,
            ],
        ]);
    }
}
