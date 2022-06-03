<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class PetHondTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $hond_naam_array = ["Bello", "Luna", "Max", "Senna"];

        foreach ($hond_naam_array as $hond_naam){
            DB::table("pet")->insert([
                "name" => $hond_naam,
                "type" => "Hond",
                "description" => $hond_naam . " heeft nog geen beschrijving",
                "user_id" => 1
            ]);
        }
    }
}
