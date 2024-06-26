<?php

namespace App\Http\Controllers;

use App\Models\Period;
use App\Models\Pet;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class PetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('pets.index', [
            'pets' => Pet::with('user')->latest()->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:50',
            'age' => 'required|numeric',
            'difficulty' => 'required|string|max:50',
            'type' => 'required|string|max:50',
            'description' => 'required|string|max:50',
            'pet_image' => 'image',
        ]);

        if (request()->has('pet_image')) {
            $imagePath = $request->file('pet_image')->store('pets', 'public');
            $validated['pet_image'] = $imagePath;
        }
        $request->user()->pets()->create($validated);

        return redirect('/user/' . $request->user()->id);
    }

    /**
     * Display the specified resource.
     */
    public function show(Pet $pet)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pet $pet): View
    {
        $this->authorize('update', $pet);

        return \view("pets/partials/edit-pet", [
            'pet' => $pet,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pet $pet)
    {
        $this->authorize('update', $pet);

        $validated = $request->validate([
            'name' => 'required|string|max:50',
            'age' => 'required|numeric',
            'difficulty' => 'required|string|max:50',
            'type' => 'required|string|max:50',
            'description' => 'required|string',
            'pet_image' => 'image',
        ]);

        $pet->update($validated);

        return redirect('/user/' . $request->user()->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Pet $pet)
    {
        $this->authorize('delete', $pet);
        $periods = Period::where('pet_id', $pet->id)->get();

        foreach ($periods as $period) {
            $this->authorize('delete', $period);
            $period->delete();
        }
        $pet->delete();

        return redirect('/user/' . $request->user()->id);
    }
}
