<li class="u-list-style-none petGridCard" data-type-of-pet={{$pet->type}}>
    <article>
        <header class="petGridCard__Header">
            <h2 class="petGridCard__Heading">{{$pet->name}}</h2>
        </header>
        <figure class="petGridCard__figure">
            <img class="petGridCard__image" src="{{$pet->image}}" alt="{{$pet->name . ", " . $pet->type}}">
        </figure>
        <section class="petGridCard__info">
            <a href="/baasjes/{{$pet->myOwner->id}}" class="petGridCard__ownerLink">
                <article class="petGridCard__infoOwner">

                    <p>Baasje:&nbsp;

                    <figure class="petGridCard__ownerFigure">
                        <img src="{{$pet->myOwner->image}} " alt="{{$pet->myOwner->name . " " . $pet->myOwner->last_name}}" class="petGridCard__userImage"/>
                    </figure>

                    <p>&nbsp;{{$pet->myOwner->name . " " . $pet->myOwner->last_name}}</p>
                </article>
            </a>
            <p>Type: {{$pet->type}}</p>
        </section>
        <section class="petGridCard__buttonSection">
            <a href="/dieren/{{$pet->id}}" class="petGridCard__buttonLink">
                <button class="petGridCard__button">Bekijk {{$pet->name}}</button>
            </a>
        </section>
    </article>
</li>
