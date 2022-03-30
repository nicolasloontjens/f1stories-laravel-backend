<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class RaceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $races = [
            [
                'title' => 'Bahrain GP',
                'date' => '2022-03-20'
            ],
            [
                'title' => 'Saudi Arabian GP',
                'date' => '2022-03-27'
            ],[
                'title' => 'Australian GP',
                'date' => '2022-04-10'
            ],[
                'title' => 'Italian GP (Imola)',
                'date' => '2022-04-24'
            ],[
                'title' => 'US Miami GP',
                'date' => '2022-05-08'
            ],[
                'title' => 'Spanish GP',
                'date' => '2022-05-22'
            ],[
                'title' => 'Monaco GP',
                'date' => '2022-05-29'
            ],[
                'title' => 'Azerbaijan GP',
                'date' => '2022-06-12'
            ],[
                'title' => 'Canadian GP',
                'date' => '2022-06-19'
            ],[
                'title' => 'British GP',
                'date' => '2022-07-03'
            ],[
                'title' => 'Austrian GP',
                'date' => '2022-07-10'
            ],[
                'title' => 'French GP',
                'date' => '2022-07-24'
            ],[
                'title' => 'Hungarian GP',
                'date' => '2022-07-31'
            ],[
                'title' => 'Belgian GP',
                'date' => '2022-08-28'
            ],[
                'title' => 'Dutch GP',
                'date' => '2022-09-04'
            ],[
                'title' => 'Italian GP',
                'date' => '2022-09-11'
            ],[
                'title' => 'Singapore GP',
                'date' => '2022-10-02'
            ],[
                'title' => 'Japanese GP',
                'date' => '2022-10-09'
            ],[
                'title' => 'United States GP',
                'date' => '2022-10-23'
            ],
            [
                'title' => 'Mexican GP',
                'date' => '2022-10-30'
            ],
            [
                'title' => 'Brazilian GP',
                'date' => '2022-11-13'
            ],
            [
                'title' => 'Abu Dhabi GP',
                'date' => '2022-11-20'
            ],
        ];

        DB::table("races")->insert($races);
    }
}
