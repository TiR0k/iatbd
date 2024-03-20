<div class="max-w-2xl mx-auto mt-1">
    <div class="bg-white shadow-sm rounded-lg p-4 flex-col" style="width: 92%; margin-left: 8%">
        <div class="flex">
            <div>
                @if($comment->user->image)
                    <img src="{{url('storage/' . $comment->user->image)}}" alt="profile img"
                         style="width: 45px; max-width: 50px; border-radius: 50%;  margin-right: 5px; aspect-ratio: 1/1; object-fit: cover">
                @else
                    <img src="{{url('images/default_profile.webp')}}" alt="profile img"
                         style="width: 45px; border-radius: 50%;  margin-right: 5px; aspect-ratio: 1/1; object-fit: cover">
                @endif
            </div>
            <div class="flex-1">
                <div class="flex-col ml-2">
                    <div class="flex justify-between items-center align-baseline">
                        <div>
                            <a class="text-gray-800"
                               href="/user/{{$comment->user->id}}">{{ $comment->user->name }}</a>
                            <small
                                class="text-sm text-gray-600">{{ $comment->created_at->format('j M Y, g:i a') }}</small>
                            @unless ($comment->created_at->eq($comment->updated_at))
                                <small class="text-sm text-gray-600"> &middot; {{ __('edited') }}</small>
                            @endunless
                        </div>
                        @if ($comment->user->is(auth()->user()))
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
                                        x-on:click.prevent="$dispatch('open-modal', 'edit-comment-{{$comment->id}}')">
                                        {{ __('Edit') }}
                                    </x-dropdown-link>
                                    <form method="POST" action="{{ route('comments.destroy', $comment) }}">
                                        @csrf
                                        @method('delete')
                                        <x-dropdown-link onclick="event.preventDefault(); this.closest('form').submit();"
                                                         style="color: red">
                                            {{ __('Delete') }}
                                        </x-dropdown-link>
                                    </form>
                                </x-slot>
                            </x-dropdown>
                        @endif
                    </div>

                    <p style="font-size: 20px">
                        {{$comment->message}}
                    </p>
                </div>
            </div>

        </div>
    </div>
</div>

<x-modal name="edit-comment-{{$comment->id}}">
    @include('comments.edit-comment', $comment)
</x-modal>
