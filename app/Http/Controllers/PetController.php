<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PetController extends Controller
{
    public function show($id){
        return view("pet.show",[
            "pet" => \App\Models\Pet::find($id),

        ]);
    }

    public function index(){
        return view("pet.index",[
            "pet" => \App\Models\Pet::all(),
        ]);
    }

    public function home(){
        return view("home",[
            "pet" => \App\Models\Pet::all(),
        ]);
    }

    public function create(){
        return view("pet.create", ["type_of_pet" => \App\Models\TypeOfPet::all()]);
    }

    public function store(Request $request, \App\Models\Pet $pet){
        $pet->name = $request->input("name");
        $pet->type = $request->input("type");
        $pet->description = $request->input("description");

        if(!$request->input("image")){
            $pet->image = "/img/photo-placeholder.jpg";
        }else{
            $pet->image = $request->input("image");
        }

        $pet->user_id = Auth::id();

        $pet->save();

        if($pet->save()){
            return redirect("/dieren/{$pet->id}");
        }

        return redirect("/dieren/create");
    }
}
