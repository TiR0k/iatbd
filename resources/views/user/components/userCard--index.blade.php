<li class="u-list-style-none userGridCard">
    <article>
        <header class="userGridCard__Header">
            <h2 class="userGridCard__Heading">{{$user->name . " " . $user->last_name}}</h2>
        </header>
        <figure class="userGridCard__figure">
            <img class="userGridCard__image" src="{{$user->image}}" alt="{{$user->name . " " . $user->last_name}}">
        </figure>
        <section class="userGridCard__info">

        </section>
        <section class="userGridCard__buttonSection">
            <a href="/baasjes/{{$user->id}}" class="userGridCard__buttonLink">
                <button class="userGridCard__button">Bekijk {{$user->name}}'s dieren</button>
            </a>
        </section>
    </article>
</li>
