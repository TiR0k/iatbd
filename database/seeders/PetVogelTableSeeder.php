<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class PetVogelTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $vogel_naam_array = ["Rico", "Jinx", "Coco", "Noodle"];

        foreach ($vogel_naam_array as $vogel_naam){
            DB::table("pet")->insert([
                "name" => $vogel_naam,
                "type" => "Vogel",
                "description" => $vogel_naam . " heeft nog geen beschrijving",
                "user_id" => 1
            ]);
        }
    }
}
