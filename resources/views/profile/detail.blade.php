<x-app-layout>
    <x-slot name="header">
        <link href="{{ asset('css/profileDetail.css') }}" rel="stylesheet" type="text/css">
        <div class="info">
            @if($user->image)
                <img class="profileImg" src="{{url('storage/' . $user->image)}}" alt="profile img">
            @else
                <img class=profileImg src="{{url('images/default_profile.webp')}}">
            @endif
            <div style="height: 100%">
                <h1 class="text-gray-800 leading-tight">
                    {{$user->name}}
                </h1>
                <p>{{$user->description != null ? $user->description : 'User has no description'}}</p>

                <div hidden>
                    {{$rating_dupe = $rating}}
                </div>

                <div class="mt-10">
                    @foreach(range(1,5) as $i)
                        <span class="fa-stack" style="width:1em; text-shadow: 2px 2px 3px rgba(0, 0, 0, 0.3);">
                        <i class="fas fa-star fa-stack-1x" style="color: #ddd"></i>
                        @if($rating_dupe != null)
                                @if($rating_dupe >0.5)
                                    <i class="fas fa-star fa-stack-1x" style="color: #FFD700"></i>
                                @elseif($rating_dupe <= 0.5 && $rating_dupe > 0)
                                    <i class="fas fa-star-half fa-stack-1x"
                                       style="color: #FFD700; text-shadow: none;"></i>
                                @endif
                                @php $rating_dupe--; @endphp
                            @endif
                        </span>
                    @endforeach
                    <span class="align-sub ml-2" style="color: #1a202c">{{$rating}} rating </span>
                    <a href="/user/{{$user->id}}/reviews" class="align-sub" style="color: gray">of {{$review_amount}}
                        reviews</a><br>
                </div>

            </div>
        </div>
    </x-slot>


    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="flex justify-between">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                        Pets
                    </h2>
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
                    <p class="text-gray-600">No pets to show</p>
                @else
                    <div class="flex" style="overflow-x: scroll; min-width: 100%; max-width: 100%;padding: 5px">
                        @foreach($pets as $pet)
                            @include('pets/partials/pet-card')
                        @endforeach
                    </div>
                @endif
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Home</h2>
                @if($user->is(auth()->user()))
                    <p>Show others your home to make sure it's pet safe</p>
                @else
                    <p class="text-gray-600">Nothing to show</p>
                @endif
            </div>

            <div class="max-w-7xl mx-auto">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg justify-around">
                    <div class="p-6 text-gray-900">
                        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                            Jobs
                        </h2>
                        <div class="flex gap-5"
                             style="overflow-x: scroll; min-width: 100%; max-width: 100%;padding: 5px">
                            @forelse($jobs as $period)
                                @include('dashboard/partials/job')
                            @empty
                                <p class="text-gray-600">nothing to show</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>

            <div class="max-w-7xl mx-auto">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg justify-around">
                    <div class="p-6 text-gray-900">
                        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                            Requests
                        </h2>
                        <div class="flex gap-5"
                             style="overflow-x: scroll; min-width: 100%; max-width: 100%;padding: 5px">
                            @forelse($requests as $period)
                                @include('dashboard/partials/job')
                            @empty
                                <p class="text-gray-600">nothing to show</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
</x-app-layout>

<x-modal name="add-pet">
    @include('pets.partials.add-pet')
</x-modal>

