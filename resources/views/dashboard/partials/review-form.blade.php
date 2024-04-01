<div class="p-6 flex-col space-x-2 shadow rounded-lg" style="max-width: 26%; min-width: 26%">
    <link href="{{ 'css/rating.css'}}" rel="stylesheet" type="text/css">
    <div>
        <div class="flex mb-4">
            <div>
                @if($review->image)
                    <img src="{{url('storage/' . $review->image)}}" alt="profile img"
                         style="width: 30px; border-radius: 50%;  margin-right: 5px; aspect-ratio: 1/1; object-fit: cover">
                @else
                    <img src="{{url('images/default_profile.webp')}}" alt="profile img"
                         style="width: 30px; border-radius: 50%;  margin-right: 5px; aspect-ratio: 1/1; object-fit: cover">
                @endif
            </div>
            <div class="flex-1">
                <a class="text-gray-800"
                   href="/user/{{$review->user_id}}">{{ $review->name }}</a>
            </div>
        </div>
        <div>
            <form method="post" action="{{route('reviews.update', $review->id)}}">
                @csrf
                @method("PATCH")
                <div class="rating-group" style="padding: 0">
                    <input class="rating__input rating__input--none" checked name="rating" id="rating2-0" value="0"
                           type="radio">
                    <label aria-label="0 stars" class="rating__label" for="rating2-0">&nbsp;</label>
                    <label aria-label="0.5 stars" class="rating__label rating__label--half" for="rating2-05"><i
                            class="rating__icon rating__icon--star fa fa-star-half"></i></label>
                    <input class="rating__input" name="rating" id="rating2-05" value="0.5" type="radio">
                    <label aria-label="1 star" class="rating__label" for="rating2-10"><i
                            class="rating__icon rating__icon--star fa fa-star"></i></label>
                    <input class="rating__input" name="rating" id="rating2-10" value="1" type="radio">
                    <label aria-label="1.5 stars" class="rating__label rating__label--half" for="rating2-15"><i
                            class="rating__icon rating__icon--star fa fa-star-half"></i></label>
                    <input class="rating__input" name="rating" id="rating2-15" value="1.5" type="radio">
                    <label aria-label="2 stars" class="rating__label" for="rating2-20"><i
                            class="rating__icon rating__icon--star fa fa-star"></i></label>
                    <input class="rating__input" name="rating" id="rating2-20" value="2" type="radio">
                    <label aria-label="2.5 stars" class="rating__label rating__label--half" for="rating2-25"><i
                            class="rating__icon rating__icon--star fa fa-star-half"></i></label>
                    <input class="rating__input" name="rating" id="rating2-25" value="2.5" type="radio">
                    <label aria-label="3 stars" class="rating__label" for="rating2-30"><i
                            class="rating__icon rating__icon--star fa fa-star"></i></label>
                    <input class="rating__input" name="rating" id="rating2-30" value="3" type="radio">
                    <label aria-label="3.5 stars" class="rating__label rating__label--half" for="rating2-35"><i
                            class="rating__icon rating__icon--star fa fa-star-half"></i></label>
                    <input class="rating__input" name="rating" id="rating2-35" value="3.5" type="radio">
                    <label aria-label="4 stars" class="rating__label" for="rating2-40"><i
                            class="rating__icon rating__icon--star fa fa-star"></i></label>
                    <input class="rating__input" name="rating" id="rating2-40" value="4" type="radio">
                    <label aria-label="4.5 stars" class="rating__label rating__label--half" for="rating2-45"><i
                            class="rating__icon rating__icon--star fa fa-star-half"></i></label>
                    <input class="rating__input" name="rating" id="rating2-45" value="4.5" type="radio">
                    <label aria-label="5 stars" class="rating__label" for="rating2-50"><i
                            class="rating__icon rating__icon--star fa fa-star"></i></label>
                    <input class="rating__input" name="rating" id="rating2-50" value="5" type="radio">
                </div>
                <textarea name="review"
                          class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-4" placeholder="Write Review"></textarea>

                <div class="justify-end w-max flex">
                    <x-primary-button class="mt-4" type="submit">{{ __('Post') }}</x-primary-button>
                </div>

            </form>
        </div>
    </div>
</div>
