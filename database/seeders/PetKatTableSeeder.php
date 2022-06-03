<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class PetKatTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $kat_naam_array = ["Simba", "Nala", "Tijger", "Minoes"];

        foreach ($kat_naam_array as $kat_naam){
            DB::table("pet")->insert([
                "name" => $kat_naam,
                "type" => "Kat",
                "description" => $kat_naam . " heeft nog geen beschrijving",
                "user_id" => 1
            ]);
        }
    }
}
