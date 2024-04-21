<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="font-semibold text-xl text-gray-800 leading-tight">
                    Requests
                </h1>
            </div>
            <div class="flex gap-4">
                <x-filter>
                    <x-slot name="trigger">
                        <x-secondary-button>FILTER REQUESTS <i class="fa fa-filter ml-2"></i></x-secondary-button>
                    </x-slot>
                    <x-slot name="content">
                        <form action="{{ route('requests.index')}}">
                            <div class="flex-col gap-4 mb-2">
                                @foreach($filterItems as $filterItem)
                                    @if($filterItem->name != "difficulty")
                                        <div class="flex-col mb-4">
                                            <label for="{{$filterItem->name}}">{{$filterItem->label}}</label>
                                            <br>
                                            <input type='{{$filterItem->type}}' name="{{$filterItem->name}}"
                                                   class="rounded-md"/>
                                        </div>
                                    @elseif($filterItem->name === "difficulty")
                                        <div class="flex-col mb-4">
                                            <label for="{{$filterItem->name}}">{{$filterItem->label}}</label>
                                            <br>
                                            <select name="{{$filterItem->name}}" class="rounded-md">
                                                <option value="" selected disabled>Select Difficulty</option>
                                                @foreach($filterItem->options as $option)
                                                    <option value="{{$option}}">{{$option}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    @endif
                                @endforeach

                            </div>
                            <x-primary-button type="submit">APPLY FILTER</x-primary-button>
                        </form>
                    </x-slot>
                </x-filter>
                <div>
                    <x-primary-button
                            x-data=""
                            x-on:click.prevent="$dispatch('open-modal', 'add-period')"
                    >{{ __('Add Request') }}</x-primary-button>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-6">
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
                @include('periods.partials.edit-period')
            </x-modal>
        @endforeach
    </div>
    <x-modal id="modal_add" name="add-period" onopen="check">
        @include('periods.partials.add-period')
    </x-modal>
</x-app-layout>
