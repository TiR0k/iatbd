<?php

namespace App\Http\Controllers;

use App\Models\HomeImage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class HomeImageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        $validated = [
            'home_image' => 'required|image',
        ];

        foreach($request->file('images') as $image){
            $imagePath = $image->store('profile', 'public');
            $validated['home_image'] = $imagePath;
//            dd($imagePath);
            $request->user()->homeImages()->create($validated);
        }

        return redirect('/user/' . $request->user()->id);
    }

    /**
     * Display the specified resource.
     */
    public function show(HomeImage $homeImage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(HomeImage $homeImage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, HomeImage $homeImage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(HomeImage $homeImage)
    {
        //
    }
}
