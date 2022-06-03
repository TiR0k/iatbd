<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
   protected $table = "pet";
   public $timestamps = false;

   public function typeModel(){
       return $this->belongsTo(\App\Models\TypeOfPet::class, "type", "type");
   }

   public function myOwner(){
           return $this->belongsTo(\App\Models\User::class , "user_id", "id");
   }
}
