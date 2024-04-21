<section class="shadow pet-card" >
    <link href="{{ asset('css/petCard.css') }}" rel="stylesheet" type="text/css">
        <div class="flex justify-end">
        @if ($pet->user->is(auth()->user()))
            <x-dropdown >
                <x-slot name="trigger" style="display: flex !important; justify-content: end">
                    <button>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                        </svg>
                    </button>
                </x-slot>
                <x-slot name="content">
                    <x-dropdown-link :href="route('pets.edit', $pet)">
                        {{ __('Edit Pet') }}
                    </x-dropdown-link>
                    <form method="POST" action="{{ route('pets.destroy', $pet) }}">
                        @csrf
                        @method('delete')
                        <x-dropdown-link :href="route('pets.destroy', $pet)" onclick="event.preventDefault(); this.closest('form').submit();" style="color: red">
                            {{ __('Delete') }}
                        </x-dropdown-link>
                    </form>
                </x-slot>
            </x-dropdown>
        @endif
    </div>

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

<x-modal name="edit-pet">
    @include('pets.partials.edit-pet')
</x-modal>
