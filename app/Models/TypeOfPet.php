<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeOfPet extends Model
{
    protected $table = "type_of_pet";

    public function allPets(){
        return $this->hasMany("\App\Models\Pet", "type", "type");
    }
}
