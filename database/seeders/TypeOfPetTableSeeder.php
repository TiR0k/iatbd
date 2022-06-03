<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class TypeOfPetTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types_array = ["Hond", "Kat", "Vogel", "Anders"];

        foreach ($types_array as $type) {
            DB::table("type_of_pet")->insert([
                "type" => $type
            ]);
        }
    }
}

