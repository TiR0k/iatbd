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
        <input class="shadow-sm rounded-lg" style="width: 100%" id="comment" name="message"
               type="text" placeholder="Leave a reply">
        <input hidden name="period_id" type="number" value="{{$period->id}}">
    </div>
    <div class="flex max-w-2xl mx-auto mt-2 mb-6 justify-end">
        <x-primary-button onclick="event.preventDefault(); this.closest('form').submit();">{{ __('Reply') }}</x-primary-button>
    </div>
</form>
