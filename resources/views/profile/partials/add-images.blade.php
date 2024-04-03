<section class="space-y-6" >
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8" >
        <form id="imagesForm" action="{{ route('homeImages.store') }}" method="POST" enctype="multipart/form-data" >
            @csrf
            <div class="mt-5">
                <x-input-label for="selectHouseImage" :value="__('Upload Images')"/>
                <input type="file" name="images[]" id="selectHouseImage" required multiple>

                <div id="previewImages" style="display: flex; flex-wrap: wrap; gap: 5px"></div>
                <script>
                    const selectHouseImage = document.getElementById('selectHouseImage')
                    const previewImages = document.getElementById('previewImages')
                    const imagesForm = document.getElementById('imagesForm')

                    change = () => {
                        let files = selectHouseImage.files;
                        let fileArr = Array.from(files)
                        fileArr.forEach(file => {
                            let img = new Image()
                            img.src = URL.createObjectURL(file)
                            img.style.display = 'block'
                            img.style.width = '100px'
                            img.style.height = '100px'
                            img.classList.add('imgPreview')
                            img.classList.add('shadow')
                            previewImages.appendChild(img)
                            console.log(previewImages)
                        })
                    }
                    selectHouseImage.addEventListener('change', change)

                    handleClick = (e) => {
                        imagesForm.reset()
                        let images = document.getElementsByClassName('imgPreview')
                        while (images[0]) images[0].parentNode.removeChild(images[0])
                    }
                </script>
            </div>

            {{--            BUTTONS--}}
            <div class="sm:flex justify-between">
                <x-secondary-button class="mt-4" @click=" handleClick; $dispatch('close')">
                    {{ __('Cancel') }}
                </x-secondary-button>
                <x-primary-button class="mt-4" type="submit">{{ __('Add Images') }}</x-primary-button>
            </div>
        </form>
    </div>
</section>

