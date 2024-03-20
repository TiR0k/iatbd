<section class="space-y-6">
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8" x-init="$watch('show', open => {
  check(open, $el)
})">
        <form action="{{ route('requests.update', $period) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class="mt-5">
                <x-input-label for="start_date" :value="__('Start Date')"/>
                <x-text-input value="{{ old('start_date', $period->start_date->format('Y-m-d'))}}" name="start_date" type="date" min="{{date('Y-m-d')}}"  onChange="changeStart(this)" class="mt-1 block w-full"/>
            </div>

            <div class="mt-5">
                <x-input-label for="end_date" :value="__('End Date')"/>
                <x-text-input value="{{ old('end_date', $period->end_date->format('Y-m-d'))}}" name="end_date" type="date" min="{{date('Y-m-d')}}" class="end_date mt-1 block w-full"/>
            </div>

            <div class="mt-5" style="display: flex; flex-direction: column">
                <x-input-label for="pet_id" :value="__('Pet')"/>
                <select value="bob"class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm'"
                        name="pet_id" >
                    <option value="" disabled>Choose Pet</option>
                    @foreach($pets as $pet)
                          <option value="{{$pet->id}}" {{$period->pet_id === $pet->id ? "selected" : ""}}>{{$pet->name}}</option>
                    @endforeach
                </select>
            </div>

            <div class="mt-5">
                <x-input-label for="hourly_wage" :value="__('Hourly Wage')"/>
                <x-text-input value="{{ old('hourly_wage', $period->hourly_wage)}}" id="hourly_wage" name="hourly_wage" type="number" step="0.01" class="mt-1 block w-full"/>
            </div>

            {{--BUTTONS--}}
            <div class="sm:flex justify-between">
                <x-secondary-button class="mt-4" x-on:click="$dispatch('close')">
                    {{ __('Cancel') }}
                </x-secondary-button>
                <x-primary-button class="mt-4" type="submit">{{ __('Update Pet') }}</x-primary-button>
            </div>
        </form>
    </div>
</section>
