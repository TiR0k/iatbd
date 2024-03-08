<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Upload Profile Image') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('') }}
        </p>
    </header>

    <div class="card-body">
        <form action="{{route('profile.addAvatar')}}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('patch')
            <input type="file" name="image">
            @if(auth()->user()->image !== null)
                <img style="width: 100px; border-radius: 50%" src={{ url('storage/'. auth()->user()->image) }} alt="img" />
            @endif
            <div>
                <x-primary-button type="submit">Upload</x-primary-button>


                @if (session('status') === 'image-uploaded')
                    <p
                        x-data="{ show: true }"
                        x-show="show"
                        x-transition
                        x-init="setTimeout(() => show = false, 2000)"
                        class="text-sm text-gray-600"
                    >{{ __('Image Uploaded.') }}</p>
                @endif
            </div>
        </form>
        <form action="{{route('profile.deleteAvatar')}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('patch')
            <x-danger-button type="submit">delete</x-danger-button>

        </form>
    </div>
</section>
