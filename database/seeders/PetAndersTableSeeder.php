<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class PetAndersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ander_type_naam_array = ["Mr. Bojangles", "Speedy", "Nugget"];

        foreach ($ander_type_naam_array as $ander_type_naam){
            DB::table("pet")->insert([
                "name" => $ander_type_naam,
                "type" => "Anders",
                "description" => $ander_type_naam . " heeft nog geen beschrijving",
                "user_id" => 1
            ]);
        }

        DB::table("pet")->insert([
            "name" => "Jeroen",
            "type" => "Anders",
            "description" => "Jeroen is makkelijk in de omgang en gaat heel goed samen met andere huisdieren. Hij is snel tevreden en met een css-kunstwerkje is hij uren zoet. Het ideale huisdier voor de beginnende oppasser.",
            "image" => "/img/Jeroen.png",
            "user_id" => 3
        ]);

    }
}
