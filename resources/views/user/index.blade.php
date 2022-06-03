@extends("default")

@section("title")
    {{"Baasjes in de buurt"}}
@endsection

@section("content")
    <ul class="u-grid-12 u-grid-gap-2">
        @foreach($users as $user)
            @include("user.components.userCard--index")
        @endforeach
    </ul>
