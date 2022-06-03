@extends("default")

@section("title")
    {{"$pet->name"}}
@endsection

@section("content")
    @include("pet.components.petCard--show")

