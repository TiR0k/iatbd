@php use function PHPUnit\Framework\isEmpty; @endphp
<x-app-layout>
    <x-slot name="header">
        <link href="{{ asset('css/profileDetail.css') }}" rel="stylesheet" type="text/css">
        <div class="info">
            @if($user->image)
                <img class="profileImg" src="{{url('storage/' . $user->image)}}" alt="profile img">
            @else
                <img class=profileImg src="{{url('images/default_profile.webp')}}">
            @endif
            <div>
                <h1 class="text-gray-800 leading-tight">
                    {{$user->name}}
                </h1>
                <p>Hier komt een gezellig stukje informatie over de gebruiker</p>
            </div>
        </div>
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="flex justify-between">
                    <div>
                        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                            Pets
                        </h2>
                    </div>
                    @if($user->is(auth()->user()))
                        <div>
                            <x-primary-button
                                x-data=""
                                x-on:click.prevent="$dispatch('open-modal', 'add-pet')"
                            >{{ __('Add Pet') }}</x-primary-button>
                        </div>
                    @endIf
                </div>
                @if($pets->count() === 0)
                    <p>No pets to show</p>
                @else
                    <div class="flex" style="overflow-x: scroll; min-width: 100%; max-width: 100%;padding: 5px">
                        @foreach($pets as $pet)
                            @include('pets/partials/pet-card')
                        @endforeach
                    </div>
                @endif
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <h2>Home</h2>
                <p>Hier kun je foto's plaatsen van je huis</p>
            </div>
        </div>
    </div>
</x-app-layout>

<x-modal name="add-pet">
    @include('pets.partials.add-pet')
</x-modal>
