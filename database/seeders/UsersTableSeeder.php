<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            "name" => "Tim",
            "last_name" => "Roks",
            "email" => "s1130082@student.hsleiden.nl",
            "password" => bcrypt("Wachtwoord"),
            "image" => ("/img/tim.jpg")
        ]);

        DB::table('users')->insert([
            "name" => "Jaap",
            "last_name" => "Kanbier",
            "email" => "kanbier.j@hsleiden.nl",
            "password" => bcrypt("Wachtwoord"),
            "image" => ("/img/jaap.jpg")
        ]);

        DB::table('users')->insert([
            "name" => "Danique",
            "last_name" => "Valstar",
            "email" => "valstar.d@hsleiden.nl",
            "password" => bcrypt("Wachtwoord"),
            "image" => ("/img/danique.png")
        ]);
    }
}
