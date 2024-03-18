<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="font-semibold text-xl text-gray-800 leading-tight">
                    Requests
                </h1>
            </div>
            <div>
                <x-primary-button
                    x-data=""
                    x-on:click.prevent="$dispatch('open-modal', 'add-period')"
                >{{ __('Add Request') }}</x-primary-button>
            </div>
        </div>
    </x-slot>

    @foreach ($periods as $period)
        <div class="max-w-2xl mx-auto mt-6">
            <div class="bg-white shadow-sm rounded-lg divide-y">
                <div class="p-6 flex space-x-2">
                    <div>
                        <input type="hidden" name="id" value="{{$period->id}}"/>
                        <div class="flex mb-4">
                            @if($period->user->image)
                                <img src="{{url('storage/' . $period->user->image)}}" alt="profile img"
                                     style="width: 45px; border-radius: 50%;  margin-right: 5px; aspect-ratio: 1/1; object-fit: cover">
                            @else
                                <img src="{{url('images/default_profile.webp')}}" alt="profile img"
                                     style="width: 45px; border-radius: 50%;  margin-right: 5px; aspect-ratio: 1/1; object-fit: cover">
                            @endif
                            <div class="flex">
                                <div>
                                    <a class="text-gray-800"
                                       href="/user/{{$period->user->id}}">{{ $period->user->name }}</a>
                                    <small
                                        class="ml-2 text-sm text-gray-600">{{ $period->created_at->format('j M Y, g:i a') }}</small>
                                </div>
                            </div>
                            @if ($period->user->is(auth()->user()))
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
                                        <x-dropdown-link
                                            x-on:click.prevent="$dispatch('open-modal', 'edit-period-{{$period->id}}')">
                                            {{ __('Edit Request') }}
                                        </x-dropdown-link>
                                        <form method="POST" action="{{ route('requests.destroy', $period) }}">
                                            @csrf
                                            @method('delete')
                                            <x-dropdown-link :href="route('requests.destroy', $period)"
                                                             onclick="event.preventDefault(); this.closest('form').submit();"
                                                             style="color: red">
                                                {{ __('Delete') }}
                                            </x-dropdown-link>
                                        </form>
                                    </x-slot>
                                </x-dropdown>
                            @endif
                        </div>

                        <div style="margin-left: 50px">
                            <h2 class="text-gray-800 leading-tight name">
                                Requested Period: <b>{{$period->start_date->format('d-m-Y')}}
                                    - {{$period->end_date->format('d-m-Y')}}</b>
                            </h2>
                            <h2 class="text-gray-800 leading-tight name mb-6">
                                Hourly Wage: <b>€{{$period->hourly_wage}}</b>
                            </h2>
                            <div hidden>
                                {{$pet = App\Models\Pet::where("id", $period->pet_id)->firstOrFail()}}
                            </div>
                            <div class="flex">
                                @if($pet->pet_image)
                                    <img class="shadow" src="{{url('storage/' . $pet->pet_image)}}"
                                         alt="pet img"
                                         style="border-radius: 50%; aspect-ratio: 1/1; object-fit: cover; width: 100px;">
                                @else
                                    <img class="shadow" src="{{url('images/default_profile.webp')}}"
                                         alt="pet img"
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
                        </div>

                    </div>
                </div>
            </div>
            <div hidden>
                {{$comments = App\Models\Comment::where('period_id', $period->id)->get() != null ? App\Models\Comment::where('period_id', $period->id)->get() : null}}
            </div>
            @foreach($comments as $comment)
                <div class="max-w-2xl mx-auto mt-1">
                    <div class="bg-white shadow-sm rounded-lg p-4 flex-col" style="width: 92%; margin-left: 8%">
                        <div class="flex">
                            @if($comment->user->image)
                                <img src="{{url('storage/' . $comment->user->image)}}" alt="profile img"
                                     style="width: 45px; border-radius: 50%;  margin-right: 5px; aspect-ratio: 1/1; object-fit: cover">
                            @else
                                <img src="{{url('images/default_profile.webp')}}" alt="profile img"
                                     style="width: 45px; border-radius: 50%;  margin-right: 5px; aspect-ratio: 1/1; object-fit: cover">
                            @endif
                            <div class="flex">
                                <div>
                                    <a class="text-gray-800"
                                       href="/user/{{$comment->user->id}}">{{ $comment->user->name }}</a>
                                    <small class="ml-2 text-sm text-gray-600">{{ $comment->created_at->format('j M Y, g:i a') }}</small>
                                </div>
                            </div>
                        </div>
                        <p style="margin-left: 50px">
                            {{$comment->message}}
                        </p>
                    </div>
                </div>
                    @endforeach
                    <div>
                        <form action="{{ route('comments.store') }}" method="POST">
                            @csrf
                            @method('POST')
                            <div class="flex max-w-2xl mx-auto mt-2">
                                @if(Auth::user()->image)
                                    <img src="{{url('storage/' . Auth::user()->image)}}" alt="profile img"
                                         style="width: 45px; border-radius: 50%;  margin-right: 5px; aspect-ratio: 1/1; object-fit: cover">
                                @else
                                    <img src="{{url('images/default_profile.webp')}}" alt="profile img"
                                         style="width: 45px; border-radius: 50%;  margin-right: 5px; aspect-ratio: 1/1; object-fit: cover">
                                @endif
                                <input class="shadow-sm rounded-lg" style=" width: 100%" id="comment" name="message"
                                       type="text" placeholder="Leave a reply">
                                <input hidden name="period_id" type="number" value="{{$period->id}}">
                            </div>
                            <div class="flex max-w-2xl mx-auto mt-2 justify-end">
                                <x-primary-button type="submit">{{ __('Reply') }}</x-primary-button>
                            </div>
                        </form>

                    </div>

                <x-modal name="edit-period-{{$period->id}}">
                    @include('periods.partials.edit-period', $period)
                </x-modal>
            @endforeach


            <x-modal name="add-period">
                @include('periods.partials.add-period')
            </x-modal>

</x-app-layout>
