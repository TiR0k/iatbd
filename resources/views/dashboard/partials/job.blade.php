<div class="p-6 flex-col space-x-2 shadow rounded-lg" style="max-width: 26%; min-width: 26%">
    <div>
        <input type="hidden" name="id" value="{{$period->id}}"/>
        <div class="flex mb-4">
            <div>
                @if($period->user->image)
                    <img src="{{url('storage/' . $period->user->image)}}" alt="profile img"
                         style="width: 30px; border-radius: 50%;  margin-right: 5px; aspect-ratio: 1/1; object-fit: cover">
                @else
                    <img src="{{url('images/default_profile.webp')}}" alt="profile img"
                         style="width: 30px; border-radius: 50%;  margin-right: 5px; aspect-ratio: 1/1; object-fit: cover">
                @endif
            </div>
            <div class="flex-1">
                <div class="flex justify-between items-center align-baseline">
                    <a class="text-gray-800"
                       href="/user/{{$period->user->id}}">{{ $period->user->name }}</a>
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
            </div>
        </div>

        <div>
            <h2 class="text-gray-800 leading-tight">
                Period:
                <b>{{$period->start_date->format('d-m-Y')}}
                    - {{$period->end_date->format('d-m-Y')}}</b>
            </h2>
            @if ($period->user->is(auth()->user()))
                <h2 class="text-gray-800 leading-tight flex gap-2">
                    Assigned to:
                    @if(!empty($period->assigned_to_id))
                        <div hidden>
                            {{$user = \App\Models\User::where('id',$period->assigned_to_id)->firstorfail()}}
                        </div>
                        <div class="flex">
                            @if($user->image)
                                <img src="{{url('storage/' . $user->image)}}" alt="profile img"
                                     style="width: 20px; border-radius: 50%;  margin-right: 5px; aspect-ratio: 1/1; object-fit: cover">
                            @else
                                <img src="{{url('images/default_profile.webp')}}" alt="profile img"
                                     style="width: 20px; border-radius: 50%;  margin-right: 5px; aspect-ratio: 1/1; object-fit: cover">
                            @endif
                            <a href="/user/{{$user->id}}"><b>{{$user->name}}</b></a>
                        </div>
                    @else
                        <p class="text-gray-600"> Request not yet assigned</p>
                    @endif

                </h2>
            @endif

            <h2 class="text-gray-800 leading-tight mb-6">
                Hourly Wage: <b>€{{$period->hourly_wage}}</b>
            </h2>
            <div hidden>
                {{$pet = App\Models\Pet::where("id", $period->pet_id)->firstOrFail()}}
            </div>
            <div class="flex">
                @if($pet->pet_image)
                    <img class="shadow" src="{{url('storage/' . $pet->pet_image)}}"
                         alt="pet img"
                         style="width: 60%; height:60%; border-radius: 50%; aspect-ratio: 1/1; object-fit: cover; ">
                @else
                    <img class="shadow" src="{{url('images/default_profile.webp')}}"
                         alt="pet img"
                         style="width: 60%; height:60%; border-radius: 50%; aspect-ratio: 1/1; object-fit: cover; ">
                @endif
                <div class="pet-info ml-4">
                    <h2 class="leading-tight" style="font-weight: 800;font-size: 20px;">
                        {{$pet->name}}
                    </h2>
                    <p>Age: {{$pet->age}}</p>
                    <p>Difficulty: {{$pet->difficulty}}</p>
                    <p>Type: {{$pet->type}}</p>
                </div>
            </div>
            <div class="mt-6" style="width: 100%">
                <p class="text-gray-600">Description:</p>
                <p>{{$pet->description}}</p>
            </div>
        </div>

    </div>
</div>
