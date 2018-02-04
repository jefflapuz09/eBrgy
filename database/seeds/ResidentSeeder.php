<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon as Carbon;

class ResidentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('residents')->insert([
            'id' => '1',
            'firstName' => 'Jefferson Van',
            'middleName' => 'Lao',
            'lastName' => 'Lapuz',
            'street' => '2844 Int. 19 Aurora Blvd.',
            'brgy' => 'Sta.cruz',
            'city' => 'Manila',
            'citizenship' => 'By birth',
            'religion' => 'Catholic',
            'image' => 'img/1.jpg',
            'gender' => 1,
            'birthdate' => '1997-09-09',
            'birthPlace' => 'Brunei',
            'periodResidence' => '7 yrs',
            'civilStatus' => 'Single',
            'isActive' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('residents')->insert([
            'id' => '2',
            'firstName' => 'Maria Clarisa',
            'middleName' => 'Gaffud',
            'lastName' => 'Abrenica',
            'street' => 'Parang',
            'brgy' => 'National',
            'image' => 'img/2.jpg',
            'city' => 'Marikina',
            'citizenship' => 'By birth',
            'religion' => 'INC',
            'gender' => 2,
            'birthdate' => '1998-06-05',
            'birthPlace' => 'Brunei',
            'periodResidence' => '7 yrs',
            'civilStatus' => 'Single',
            'isActive' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('parents')->insert([
            'id' => '1',
            'residentId' => 1,
            'motherfirstName' => 'Arlene',
            'motherlastName' => 'Lapuz',
            'fatherfirstName' => 'Josefino',
            'fatherlastName' => 'Lapuz',
            'isActive' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('parents')->insert([
            'id' => '2',
            'residentId' => 2,
            'motherfirstName' => 'Arlene',
            'motherlastName' => 'Lapuz',
            'fatherfirstName' => 'Josefino',
            'fatherlastName' => 'Lapuz',
            'isActive' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
