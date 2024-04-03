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
            @if (auth()->user()->role === 'admin')
                <x-dropdown>
                    <x-slot name="trigger">
                        <button>
                            <svg xmlns="http://www.w3.org/2000/svg"
                                 class="h-4 w-4 text-gray-400"
                                 viewBox="0 0 20 20" fill="currentColor">
                                <path
                                    d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z"/>
                            </svg>
                        </button>
                    </x-slot>
                    <x-slot name="content">
                        @if(!$user->status)
                            <form method="POST" action="{{ route('profile.suspend', $user->id) }}">
                                @csrf
                                <input name="user_id" value="{{$user->id}}" hidden/>
                                <x-dropdown-link onclick="event.preventDefault(); this.closest('form').submit();"
                                                 style="color: red">
                                    {{ __('Suspend User') }}
                                </x-dropdown-link>
                            </form>
                        @else
                            <form method="POST" action="{{ route('profile.suspend')}}">
                                @csrf
                                <input name="user_id" value="{{$user->id}}" hidden/>
                                <x-dropdown-link onclick="event.preventDefault(); this.closest('form').submit();"
                                                 style="color: red">
                                    {{ __('Unsuspend User') }}
                                </x-dropdown-link>
                            </form>
                        @endif
                    </x-slot>
                </x-dropdown>
            @endif
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
                <div class="flex justify-between">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                        Home
                    </h2>
                    @if($user->is(auth()->user()))
                        <div>
                            <x-primary-button
                                x-data=""
                                x-on:click.prevent="$dispatch('open-modal', 'add-images')"
                            >{{ __('Add Images') }}</x-primary-button>
                        </div>
                    @endIf
                </div>
                <div style="display: flex; flex-wrap: wrap; gap: 10px">
                    @forelse($home_images as $home_image)
                        <img src="{{url('storage/' . $home_image->home_image)}}" alt=""
                             style="width: 200px; aspect-ratio: 1/1" class="shadow">
                    @empty
                        @if($user->is(auth()->user()))
                            <p class="text-gray-600">Show others your home to make sure it's pet safe</p>
                        @else
                            <p class="text-gray-600">Nothing to show</p>
                        @endif
                    @endforelse
                </div>


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

    <x-modal name="add-images">

        @include('profile.partials.add-images')
    </x-modal>
</x-app-layout>

<x-modal name="add-pet">
    @include('pets.partials.add-pet')
</x-modal>


