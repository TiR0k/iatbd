<section class="space-y-6">
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        <form action="{{ route('pets.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mt-5">
                <x-input-label for="pet_image" :value="__('Upload Foto')"/>
                <input type="file" name="pet_image" id="selectImage" required>

                <img id="preview" src="#" alt="your image" class="mt-3"
                     style="display:none; width: 100px; border-radius: 50%; aspect-ratio: 1 / 1; object-fit: cover;"/>
                <script>
                    selectImage.onchange = evt => {
                        preview = document.getElementById('preview');
                        preview.style.display = 'block';
                        const [file] = selectImage.files
                        if (file) {
                            preview.src = URL.createObjectURL(file)
                        }
                    }
                </script>
            </div>

            <div class="mt-5">
                <x-input-label for="name" :value="__('Name')"/>
                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" required/>
            </div>

            <div class="mt-5">
                <x-input-label for="age" :value="__('Age')"/>
                <x-text-input id="age" name="age" type="number" class="mt-1 block w-full"/>
            </div>

            <div class="mt-5" style="display: flex; flex-direction: column">
                <x-input-label for="difficulty" :value="__('Difficulty')"/>
                <select class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm'"
                        name="difficulty">
                    <option value="" selected disabled>Select Difficulty</option>
                    <option value="Beginner Friendly">Beginner Friendly</option>
                    <option value="Novice">Novice</option>
                    <option value="Experts only">Experts only</option>
                </select>
            </div>

            <div class="mt-5">
                <x-input-label for="type" :value="__('Type')"/>
                <x-text-input id="type" name="type" type="text" class="mt-1 block w-full"/>
            </div>

            <div class="mt-5">
                <x-input-label for="description" :value="__('Description')"/>
                <textarea
                    name="description"
                    placeholder="{{ __('Tell us more about your pet') }}"
                    class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                >{{ old('message') }}</textarea>
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
