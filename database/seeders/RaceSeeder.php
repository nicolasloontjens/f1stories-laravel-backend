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
        $races_nl = [
            [
                'race_id'=>1,
                'language'=>'nl',
                'title' => 'GP van Bahrein',
                'date' => '2022-03-20'
            ],
            [
                'race_id'=>2,
                'language'=>'nl',
                'title' => 'GP van Saoedi-Arabië',
                'date' => '2022-03-27'
            ],[
                'race_id'=>3,
                'language'=>'nl',
                'title' => 'Australische GP',
                'date' => '202-04-10'
            ],[
                'race_id'=>4,
                'language'=>'nl',
                'title' => 'Italiaanse GP (Imola)',
                'date' => '2022-04-24'
            ],[
                'race_id'=>5,
                'language'=>'nl',
                'title' => 'US Miami GP',
                'date' => '2022-05-08'
            ],[
                'race_id'=>6,
                'language'=>'nl',
                'title' => 'Spaanse GP',
                'date' => '2022-05-22'
            ],[
                'race_id'=>7,
                'language'=>'nl',
                'title' => 'Monaco GP',
                'date' => '2022-05-29'
            ],[
                'race_id'=>8,
                'language'=>'nl',
                'title' => 'GP Azerbeidzjan',
                'date' => '2022-06-12'
            ],[
                'race_id'=>9,
                'language'=>'nl',
                'title' => 'Canadese GP',
                'date' => '2022-06-19'
            ],[
                'race_id'=>10,
                'language'=>'nl',
                'title' => 'Britse GP',
                'date' => '2022-07-03'
            ],[
                'race_id'=>11,
                'language'=>'nl',
                'title' => 'Oostenrijkse GP',
                'date' => '2022-07-10'
            ],[
                'race_id'=>12,
                'language'=>'nl',
                'title' => 'Franse GP',
                'date' => '2022-07-24'
            ],[
                'race_id'=>13,
                'language'=>'nl',
                'title' => 'Hongaarse GP',
                'date' => '2022-07-31'
            ],[
                'race_id'=>14,
                'language'=>'nl',
                'title' => 'Belgische GP',
                'date' => '2022-08-28'
            ],[
                'race_id'=>15,
                'language'=>'nl',
                'title' => 'Nederlandse GP',
                'date' => '2022-09-04'
            ],[
                'race_id'=>16,
                'language'=>'nl',
                'title' => 'Italiaanse GP',
                'date' => '2022-09-11'
            ],[
                'race_id'=>17,
                'language'=>'nl',
                'title' => 'GP Singapore',
                'date' => '2022-10-02'
            ],[
                'race_id'=>18,
                'language'=>'nl',
                'title' => 'Japanse GP',
                'date' => '2022-10-09'
            ],[
                'race_id'=>19,
                'language'=>'nl',
                'title' => 'GP van de Verenigde Staten',
                'date' => '2022-10-23'
            ],
            [
                'race_id'=>20,
                'language'=>'nl',
                'title' => 'Mexicaanse GP',
                'date' => '2022-10-30'
            ],
            [
                'race_id'=>21,
                'language'=>'nl',
                'title' => 'Braziliaanse GP',
                'date' => '2022-11-13'
            ],
            [
                'race_id'=>22,
                'language'=>'nl',
                'title' => 'GP van Abu Dhabi',
                'date' => '2022-11-20'
            ]
        ];
        $races_fr = [
            [
                'race_id'=>1,
                'language'=>'fr',
                "title" => "GP de Bahreïn",
                "date" => "2022-03-20"
            ],
            [
                'race_id'=>2,
                'language'=>'fr',
                "title" => "GP d'Arabie Saoudite",
                "date" => "2022-03-27"
            ],[
                'race_id'=>3,
                'language'=>'fr',
                "title" => "GP d'Australie",
                "date" => "2022-04-10"
            ],[
                'race_id'=>4,
                'language'=>'fr',
                "title" => "GP d'Italie (Imola)",
                "date" => "2022-04-24"
            ],[
                'race_id'=>5,
                'language'=>'fr',
                "title" => "Grand Prix des États-Unis à Miami",
                "date" => "2022-05-08"
            ],[
                'race_id'=>6,
                'language'=>'fr',
                "title" => "GP d'Espagne",
                "date" => "2022-05-22"
            ],[
                'race_id'=>7,
                'language'=>'fr',
                "title" => "GP de Monaco",
                "date" => "2022-05-29"
            ],[
                'race_id'=>8,
                'language'=>'fr',
                "title" => "GP d'Azerbaïdjan",
                "date" => "2022-06-12"
            ],[
                'race_id'=>9,
                'language'=>'fr',
                "title" => "GP canadien",
                "date" => "2022-06-19"
            ],[
                'race_id'=>10,
                'language'=>'fr',
                "title" => "GP britannique",
                "date" => "2022-07-03"
            ],[
                'race_id'=>11,
                'language'=>'fr',
                "title" => "GP d'Autriche",
                "date" => "2022-07-10"
            ],[
                'race_id'=>12,
                'language'=>'fr',
                "title" => "GP de France",
                "date" => "2022-07-24"
            ],[
                'race_id'=>13,
                'language'=>'fr',
                "title" => "GP de Hongrie",
                "date" => "2022-07-31"
            ],[
                'race_id'=>14,
                'language'=>'fr',
                "title" => "GP de Belgique",
                "date" => "2022-08-28"
            ],[
                'race_id'=>15,
                'language'=>'fr',
                "title" => "GP néerlandais",
                "date" => "2022-09-04"
            ],[
                'race_id'=>16,
                'language'=>'fr',
                "title" => "GP d'Italie",
                "date" => "2022-09-11"
            ],[
                'race_id'=>17,
                'language'=>'fr',
                "title" => "GP de Singapour",
                "date" => "2022-10-02"
            ],[
                'race_id'=>18,
                'language'=>'fr',
                "title" => "GP du Japon",
                "date" => "2022-10-09"
            ],[
                'race_id'=>19,
                'language'=>'fr',
                "title" => "GP des États-Unis",
                "date" => "2022-10-23"
            ],
            [
                'race_id'=>20,
                'language'=>'fr',
                "title" => "GP du Mexique",
                "date" => "2022-10-30"
            ],
            [
                'race_id'=>21,
                'language'=>'fr',
                "title" => "GP du Brésil",
                "date" => "2022-11-13"
            ],
            [
                'race_id'=>22,
                'language'=>'fr',
                "title" => "GP d'Abou Dhabi",
                "date" => "2022-11-20"
            ],
        ];

        DB::table("races")->insert($races);
        DB::table('races_language')->insert($races_nl);
        DB::table('races_language')->insert($races_fr);
    }
}
