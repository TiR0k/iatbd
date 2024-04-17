<div class="max-w-2xl mx-auto mt-6">
    <div class="bg-white shadow-sm rounded-lg divide-y">
        <div class="p-6 flex-col space-x-2">
            <div>
                <input type="hidden" name="id" value="{{$period->id}}"/>
                <div class="flex mb-4">
                    <div>
                        @if($period->user_image)
                            <img src="{{url('storage/' . $period->user_image)}}" alt="profile img"
                                 style="width: 45px; border-radius: 50%;  margin-right: 5px; aspect-ratio: 1/1; object-fit: cover">
                        @else
                            <img src="{{url('images/default_profile.webp')}}" alt="profile img"
                                 style="width: 45px; border-radius: 50%;  margin-right: 5px; aspect-ratio: 1/1; object-fit: cover">
                        @endif
                    </div>
                    <div class="flex-1">
                        <div class="flex justify-between items-center align-baseline">
                            <div>
                                <a class="text-gray-800"
                                   href="/user/{{$period->user_id}}">{{ $period->user_name }}</a>
                                <small
                                        class="ml-2 text-sm text-gray-600">{{ date('j M Y, g:i a',  strtotime($period->created_at)) }}</small>
                            </div>

{{--                            {{dd(auth()->user()->name)}}--}}
                            @if ($period->user_name === (auth()->user()->name) || auth()->user()->role === 'admin')
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
                                        @if($period->user_name === (auth()->user()->name))
                                        <x-dropdown-link
                                                x-on:click.prevent="$dispatch('open-modal', 'edit-period-{{$period->id}}')">
                                            {{ __('Edit Request') }}
                                        </x-dropdown-link>
                                        @endif
                                        @if($period->user_name === (auth()->user()->name) || auth()->user()->role === 'admin')
                                            <form method="POST" action="{{ route('requests.destroy', $period->id) }}">
                                                @csrf
                                                @method('delete')
                                                <x-dropdown-link :href="route('requests.destroy', $period->id)"
                                                                 onclick="event.preventDefault(); this.closest('form').submit();"
                                                                 style="color: red">
                                                    {{ __('Delete') }}
                                                </x-dropdown-link>
                                            </form>
                                        @endif
                                    </x-slot>
                                </x-dropdown>
                            @endif
                        </div>

                    </div>
                </div>

                <div style="margin-left: 50px">
                    <h2 class="text-gray-800 leading-tight name">
                        Requested Period: <b>{{ date('j M Y, g:i a',  strtotime($period->start_date)) }}
                            - {{ date('j M Y, g:i a',  strtotime($period->end_date))}}</b>
                    </h2>
                    <h2 class="text-gray-800 leading-tight name mb-6">
                        Hourly Wage: <b>€{{$period->hourly_wage}}</b>
                    </h2>
                    <div class="flex">
                        @if($period->pet_image)
                            <img class="shadow" src="{{url('storage/' . $period->pet_image)}}"
                                 alt="pet img"
                                 style="border-radius: 50%; aspect-ratio: 1/1; object-fit: cover; width: 100px;">
                        @else
                            <img class="shadow" src="{{url('images/default_profile.webp')}}"
                                 alt="pet img"
                                 style="border-radius: 50%; aspect-ratio: 1/1; object-fit: cover; width: 100px;">
                        @endif
                        <div class="pet-info ml-4">
                            <h2 class="text-gray-800 leading-tight name">
                                {{$period->pet_name}}
                            </h2>
                            <p>Age: {{$period->pet_age}}</p>
                            <p>Difficulty: {{$period->pet_difficulty}}</p>
                            <p>Type: {{$period->pet_type}}</p>
                        </div>
                    </div>
                    <div class="mt-6" style="width: 100%">
                        <p>Description:</p>
                        <p>{{$period->pet_description}}</p>
                </div>
            </div>

        </div>
        </div>
    </div>
    <p class="text-gray-600">Comments</p>
</div>
