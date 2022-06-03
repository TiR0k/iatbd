

@extends("default")

@section("title")
    Huisdier aanmelden
@endsection

@section("content")
    <section class="create-header">
        <h1>Huisdier aanmelden</h1>
    </section>
    <article class="create-form">
        <form class="create-form__form" action="/dieren" method="POST">
            @csrf

            <section class="create-form__section">
                <label for="name">Naam</label>
                <input name="name" id="name" type="text">
            </section>

            <section class="create-form__section">
                <label for="type">Soort huisdier</label>
                <select id="type" name="type">
                    @foreach($type_of_pet as $type_of_pet)
                        <option value="{{$type_of_pet->type}}">{{$type_of_pet->type}}</option>
                    @endforeach
                </select>
            </section>

            <section class="create-form__section">
                <label for="description">Beschrijving</label>
                <textarea class="create-form__input--big" id="type" name="description" type="textarea"></textarea>
            </section>

           <section class="create-form__section">
               <label for="image">Afbeelding</label>
               <input id="image" name="image" type="text">
            </section>

            <section class="create-form__section">
                <button class="create-form__button" type="submit">Huisdier aanmelden</button>
            </section>
        </form>
    </article>

@endsection
