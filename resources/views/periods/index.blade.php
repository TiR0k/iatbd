<x-app-layout>
    <x-slot name="header">
        <div class="sm:flex justify-between sm:items-center">
            <div>
                <h1 class="font-semibold text-xl text-gray-800 leading-tight">
                    periods
                </h1>
            </div>
            <div>
                <x-primary-button
                    x-data=""
                    x-on:click.prevent="$dispatch('open-modal', 'add-period')"
                >{{ __('Add Period') }}</x-primary-button>
            </div>
        </div>
    </x-slot>

    @foreach ($periods as $period)
        <div class="max-w-2xl mx-auto mt-6">
            <div class="bg-white shadow-sm rounded-lg divide-y">
                <div class="p-6 flex space-x-2">
                    <div>
                        <div class="flex mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600 -scale-x-100"
                                 fill="none"
                                 viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                            </svg>
                            <div class="flex justify-between items-center">
                                <div>
                                    <a class="text-gray-800"
                                       href="/user/{{$period->user->id}}">{{ $period->user->name }}</a>
                                    <small
                                        class="ml-2 text-sm text-gray-600">{{ $period->created_at->format('j M Y, g:i a') }}</small>
                                </div>
                            </div>
                        </div>
                        <div style="margin-left: 25px">
                            <h2 class="text-gray-800 leading-tight name">
                                Requested Period: <b>{{$period->start_date->format('d-m-Y')}}
                                    - {{$period->end_date->format('d-m-Y')}}</b>
                            </h2>
                            <h2 class="text-gray-800 leading-tight name mb-6">
                                Hourly Wage: <b>€{{$period->hourly_wage}}</b>
                            </h2>
                            @foreach($pets as $pet)
                                @if($pet->id === $period->pet_id)
                                    <div class="flex">
                                        @if($pet->pet_image)
                                            <img class="shadow" src="{{url('storage/' . $pet->pet_image)}}" alt="pet img"
                                                 style="border-radius: 50%; aspect-ratio: 1/1; object-fit: cover; width: 100px;">
                                        @else
                                            <img class="shadow" src="{{url('images/default_profile.webp')}}" alt="pet img"
                                                 style="border-radius: 50%; aspect-ratio: 1/1; object-fit: cover; width: 100px;">
                                        @endif
                                        <div class="pet-info ml-4">
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
                                @endif
                            @endforeach
                        </div>
                    </div>

                </div>
            </div>
        </div>
    @endforeach


    <x-modal name="add-period">
        @include('periods.partials.add-period')
    </x-modal>
</x-app-layout>
<?php
