<div>
    <form method="POST" action="{{ route('profile.addDescription', $user) }}">
        @csrf
        @method('patch')
        <textarea name="description" class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">{{ $user->description != null ? old('message', $user->description) : "Tell us about yourself"}}</textarea>
        <x-input-error :messages="$errors->get('message')" class="mt-2"/>
        <div class="mt-4 space-x-2">
            <x-primary-button>{{ __('Save') }}</x-primary-button>
        </div>
    </form>
</div>
