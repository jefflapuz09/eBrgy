<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon as Carbon;

class OfficerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('officers')->insert([
            'id' => '1',
            'residentid' => '1',
            'position' => 'Kagawad',
            'isActive' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
