<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(ResidentSeeder::class);
        $this->call(OfficerSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(HouseholdSeeder::class);
    }
}
