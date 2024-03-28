<?php

namespace App\Http\Controllers;

use App\Models\Comment;
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
    public function index(): View
    {
        return view('periods.index', [
            'periods' => Period::with('user')->latest()->get()->where('assigned_to_id', null),
            'pets' => Pet::with('user')->latest()->get(),
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
            'pet_id' => 'required|numeric',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'hourly_wage' => 'required|numeric'
        ]);

        $newPeriod = $request->user()->periods()->create($validated);
        $newPeriod->reviews()->create();

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

    public function assignTo(Request $request): RedirectResponse
    {

        $period = Period::find($request['period_id']);

        $validated = request()->validate([
            'assigned_to_id' => 'required|numeric',
        ]);

        $period->update($validated);

        return redirect(route('requests.index'));
    }

}
