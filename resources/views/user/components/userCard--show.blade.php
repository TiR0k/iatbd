<article class="userCard">
    <figure class="userCard__figure">
        <img class="userCard__image"src="{{$user->image}}" alt="{{$user->name . " " . $user->last_name}}">
    </figure>
    <section class="userCard__description">
        <h1 class="userCard__name">{{$user->name . " " . $user->last_name}}</h1>
{{--        <p class="petCard__text">{{$pet->description}}</p>--}}
    </section>
</article>
