<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon as Carbon;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'id' => '1',
            'officerId' => '1',
            'email' => 'jeff.lapuz09@gmail.com',
            'password' => bcrypt('qweqwe'),
            'isActive' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('users')->insert([
            'id' => '2',
            'officerId' => '2',
            'email' => 'maria@gmail.com',
            'password' => bcrypt('qweqwe'),
            'isActive' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
