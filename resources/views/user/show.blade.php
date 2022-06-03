@extends("default")

@section("title")
    {{"$user->name"}}
@endsection

@section("content")
    @include("user.components.userCard--show")

    <h1 class="user-pets__header">{{$user->name}}'s dieren</h1>

    <ul class="u-grid-12 u-grid-gap-2">
        @foreach($user->myPets  as $pet)
            @include("pet.components.petCard--index")
        @endforeach
    </ul>
@endsection
