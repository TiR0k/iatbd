<article class="petCard">
    <figure class="petCard__figure">
        <img class="petCard__image"src="{{$pet->image}}" alt="{{$pet->name . ', ' . $pet->type}}">
    </figure>
    <section class="petCard__description">
        <h1 class="petCard__name">{{$pet->name}}</h1>
        <p class="petCard__text">{{$pet->description}}</p>
    </section>
</article>
