<section class="space-y-6">
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        <form action="{{ route('requests.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mt-5">
                <x-input-label for="start_date" :value="__('Start Date')"/>
                <x-text-input id="start_date" name="start_date" type="date" min="{{date('Y-m-d')}}" class="mt-1 block w-full" required/>
            </div>

            <div class="mt-5">
                <x-input-label for="end_date" :value="__('End Date')"/>
                <x-text-input id="end_date" name="end_date" type="date" min="{{date('Y-m-d')}}" class="mt-1 block w-full" required/>
            </div>

            <div class="mt-5" style="display: flex; flex-direction: column">
                <x-input-label for="pet_id" :value="__('Pet')"/>
                <select class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm'"
                        name="pet_id" required>
                    <option value="" selected disabled>Choose Pet</option>
                    @foreach($pets as $pet)
                        @if($pet->user_id === auth()->user()->getAuthIdentifier())
                            <option value="{{$pet->id}}">{{$pet->name}}</option>
                        @endif
                    @endforeach
                </select>
            </div>

            <div class="mt-5">
                <x-input-label for="hourly_wage" :value="__('Hourly Wage')"/>
                <x-text-input id="hourly_wage" name="hourly_wage" type="number" step="0.01" class="mt-1 block w-full" required/>
            </div>

            {{--BUTTONS--}}
            <div class="sm:flex justify-between">
                <x-secondary-button class="mt-4" x-on:click="$dispatch('close')">
                    {{ __('Cancel') }}
                </x-secondary-button>
                <x-primary-button class="mt-4" type="submit">{{ __('Add Pet') }}</x-primary-button>
            </div>
        </form>
    </div>
</section>

<script>
    let startDate = document.getElementById("start_date")
    let endDate = document.getElementById("end_date");

    startDate.onchange = () =>{
        console.log(startDate.value)
        if(startDate.value !== ""){
            endDate.min = startDate.value;
        }else{
            endDate.min = startDate.min;
        }
    }

    console.log("A change is gonna come")
</script>
