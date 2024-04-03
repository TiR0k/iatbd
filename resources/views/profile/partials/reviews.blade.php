<x-app-layout>
    <x-slot name="header">
        <div class="flex">
            @if($user->image)
                <img class="profileImg" src="{{url('storage/' . $user->image)}}" alt="profile img"
                     style="width: 45px; border-radius: 50%;  margin-right: 5px; aspect-ratio: 1/1; object-fit: cover">
            @else
                <img class=profileImg src="{{url('images/default_profile.webp')}}"
                     style="width: 45px; border-radius: 50%;  margin-right: 5px; aspect-ratio: 1/1; object-fit: cover">
            @endif
            <h1 class="text-gray-800 leading-tight font-extrabold" style="font-size: 15px; margin-top: 22px">
                {{$user->name}}
            </h1>
        </div>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight mt-2">
            {{ __('Reviews') }}
        </h2>
    </x-slot>

    @foreach($reviews as $review)
        <div class="max-w-2xl mx-auto mt-6">
            <div class="bg-white shadow-sm rounded-lg divide-y p-6">
                <div>
                    <div class="flex">
                        @if($review->image)
                            <img src="{{url('storage/' . $review->image)}}" alt="profile img"
                                 style="width: 55px; border-radius: 50%;  margin-right: 5px; aspect-ratio: 1/1; object-fit: cover">
                        @else
                            <img src="{{url('images/default_profile.webp')}}" alt="profile img"
                                 style="width: 55px; border-radius: 50%;  margin-right: 5px; aspect-ratio: 1/1; object-fit: cover">
                        @endif
                        <div class="flex-col">
                            <div class="flex-1">
                                <a class="text-gray-800"
                                   href="/user/{{$review->user_id}}">{{ $review->name }}</a>
                                <span class="ml-3 text-gray-500">{{ Carbon\Carbon::parse($review->updated_at)->diffForHumans() }}
                                </span>
                            </div>
                            <div>
                                @php $rating_dupe = $review->rating @endphp
                                @foreach(range(1,5) as $i)
                                    <span class="fa-stack"
                                          style="width:1em; text-shadow: 2px 2px 3px rgba(0, 0, 0, 0.3);">
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
                            </div>
                        </div>
                    </div>

                    <div class="mt-2">
                        {{$review->review}}
                    </div>
                </div>
            </div>
        </div>
    @endforeach

</x-app-layout>


