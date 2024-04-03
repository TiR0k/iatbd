<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function addAvatar(Request $request): RedirectResponse
    {
        $validated = request()->validate([
            'image' => ['required', 'image'],
        ]);

        if (request()->has('image')) {
            $imagePath = $request->file('image')->store('profile', 'public');
            $validated['image'] = $imagePath;
        }

        $request->user()->update($validated);

        return Redirect::route('profile.edit')->with('status', 'image-uploaded');
    }

    public function deleteAvatar(Request $request): RedirectResponse
    {
        $imgPath = $request->user()->image;

        if (Storage::exists('public/' . $imgPath)) {
            Storage::delete('public/' . $imgPath);
            $request->user()->image = null;
            $request->user()->save();
            var_dump($imgPath);
        }
        return Redirect::route('profile.edit')->with('status', 'image-deleted');
    }

    public function addDescription(Request $request): RedirectResponse
    {
        $validated = request()->validate([
            'description' => 'required|string|max:255',
        ]);

        $request->user()->update($validated);

        return redirect('/user/' . $request->user()->id);
    }

    public function suspend(Request $request): RedirectResponse
    {
        $user = User::find($request['user_id']);

        $validated = [
            'status' => ['required', 'boolean'],
        ];

        if ($user->status !== null) {
            $validated['status'] = !$user->status;
        } else {
            $validated['status'] = 1;
        }
//        dd($user->status);

        $user->update($validated);


        return redirect('/user/' . $user->id);
    }
}
