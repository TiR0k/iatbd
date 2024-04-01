<x-app-layout>
    <x-slot name="header">
        <link href="{{ 'css/rating.css'}}" rel="stylesheet" type="text/css">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg justify-around">
                <div class="p-6 text-gray-900">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                        Write a Review
                    </h2>
                    <div class="flex gap-5" style="overflow-x: scroll; min-width: 100%; max-width: 100%;padding: 5px">
                        <div class="flex gap-5"
                             style="overflow-x: scroll; min-width: 100%; max-width: 100%;padding: 5px">
                            <div class="flex gap-5" style="overflow-x: scroll; min-width: 100%; max-width: 100%;padding: 5px">
                                @forelse($reviews as $review)
                                    @include('dashboard/partials/review-form')
                                @empty
                                    <p class="text-gray-600">nothing to show</p>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg justify-around">
                <div class="p-6 text-gray-900">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                        Current and Upcomming Jobs
                    </h2>
                    <div class="flex gap-5" style="overflow-x: scroll; min-width: 100%; max-width: 100%;padding: 5px">
                        <div class="flex gap-5"
                             style="overflow-x: scroll; min-width: 100%; max-width: 100%;padding: 5px">
                            <div class="flex gap-5" style="overflow-x: scroll; min-width: 100%; max-width: 100%;padding: 5px">
                                @forelse($jobs_current as $period)
                                    @include('dashboard/partials/job')
                                @empty
                                    <p class="text-gray-600">nothing to show</p>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg justify-around">
                <div class="p-6 text-gray-900">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                        Open and Ongoing Requests
                    </h2>
                    <div class="flex gap-5" style="overflow-x: scroll; min-width: 100%; max-width: 100%;padding: 5px">
                        <div class="flex gap-5"
                             style="overflow-x: scroll; min-width: 100%; max-width: 100%;padding: 5px">
                            @forelse($periods_current as $period)
                                @include('dashboard/partials/job')
                            @empty
                                <p class="text-gray-600">nothing to show</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
