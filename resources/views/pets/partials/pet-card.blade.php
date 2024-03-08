<section class="shadow pet-card" >
    <link href="{{ asset('css/petCard.css') }}" rel="stylesheet" type="text/css">
    <div class="flex">
        @if($pet->pet_image)
            <img class="petImg shadow" src="{{url('storage/' . $pet->pet_image)}}" alt="pet img">
        @else
            <img class="petImg shadow" src="{{url('images/default_profile.webp')}}">
        @endif
        <div class="pet-info">
            <h2 class="text-gray-800 leading-tight name">
                {{$pet->name}}
            </h2>
            <p>Age: {{$pet->age}}</p>
            <p>Difficulty: {{$pet->difficulty}}</p>
            <p>Type: {{$pet->type}}</p>
        </div>
    </div>
    <div class="mt-6" style="width: 100%">
        <p>Description:</p>
        <p>{{$pet->description}}</p>
    </div>
</section>
