@extends("default")

@section("title")
    {{"Alle Dieren"}}
@endsection

@section("content")
    <section class="filter-section">
        <div class="filter-section_wrapper">
            <label class="filter-section__label" for="anders">Anders</label>
            <input class="filter-section__input" id="anders" name="anders" type="checkbox" checked="true">
        </div>

        <div class="filter-section_wrapper">
            <label class="filter-section__label" for="hond">Hond</label>
            <input class="filter-section__input" id="hond" name="hond" type="checkbox" checked="true">
        </div>

        <div class="filter-section_wrapper">
            <label class="filter-section__label" for="kat">Kat</label>
            <input class="filter-section__input" id="kat" name="kat" type="checkbox" checked="true">
        </div>

        <div class="filter-section_wrapper">
            <label class="filter-section__label" for="vogel">Vogel</label>
            <input class="filter-section__input" id="vogel" name="vogel" type="checkbox" checked="true">
        </div>
    </section>


    <ul class="u-grid-12 u-grid-gap-2">
        @foreach($pet as $pet)
            @include("pet.components.petCard--index")
        @endforeach
    </ul>
