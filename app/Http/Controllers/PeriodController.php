<?php

namespace App\Http\Controllers;

use App\Models\Period;
use App\Models\Pet;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PeriodController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {

        return view('periods.index', [
            'periods' => Period::with('user')->latest()->get(),
            'pets' => $request->user()->pets()->get(),
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
    public function store(Request $request)
    {
        $validated = $request->validate([
            'pet_id' => 'required|numeric',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'hourly_wage' => 'required|numeric'
        ]);

        $request->user()->periods()->create($validated);

        return redirect(route('requests.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Period $period)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Period $period)
    {
//
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $period_id): RedirectResponse
    {
        $period = Period::find($period_id);
        $this->authorize('update', $period);

        $validated = $request->validate([
            'pet_id' => 'required|numeric',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'hourly_wage' => 'required|numeric'
        ]);

        $period->update($validated);

        return redirect(route('requests.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $period_id)
    {
        $period = Period::find($period_id);
        $this->authorize('delete', $period);

        $period->delete();

        return redirect(route('requests.index'));
    }
}
