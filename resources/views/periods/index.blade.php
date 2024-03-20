<x-app-layout>
    <script type="text/javascript" src="{{URL::to('js/DateSelector.js')}}"></script>

    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="font-semibold text-xl text-gray-800 leading-tight">
                    Requests
                </h1>
            </div>
            <div>
                <x-primary-button
                    x-data=""
                    x-on:click.prevent="$dispatch('open-modal', 'add-period')"
                >{{ __('Add Request') }}</x-primary-button>
            </div>
        </div>
    </x-slot>

    @foreach ($periods as $period)
        @include("periods.partials.period-card")
        <div hidden>
            {{$comments = App\Models\Comment::where('period_id', $period->id)->get() != null ? App\Models\Comment::where('period_id', $period->id)->get() : null}}
        </div>

        @foreach($comments as $comment)
            @include("comments.comments")
        @endforeach

        <div>
            @include("comments.add-comment")
        </div>

        <x-modal name="edit-period-{{$period->id}}">
            @include('periods.partials.edit-period', $period)
        </x-modal>
    @endforeach


    <x-modal id="modal_add" name="add-period" onopen="check">
        @include('periods.partials.add-period')
    </x-modal>
</x-app-layout>
