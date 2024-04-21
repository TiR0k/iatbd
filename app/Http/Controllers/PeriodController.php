<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Period;
use App\Models\Pet;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class PeriodController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        foreach ($request->query as $name => $value){
            if($value === null){
                $request->query->remove($name);
            }
        }
        $periods = DB:: table('periods')
            ->select('periods.id as id', 'periods.created_at as created_at', 'periods.start_date as start_date', 'periods.end_date as end_date', 'periods.assigned_to_id', 'periods.hourly_wage', 'users.name as user_name', 'users.image as user_image', 'users.id as user_id', 'periods.hourly_wage as hourly_wage', 'pets.id as pet_id', 'pets.name as pet_name', 'pets.age as pet_age', 'pets.name as pet_name', 'pets.pet_image as pet_image', 'pets.difficulty as pet_difficulty', 'pets.type as pet_type', 'pets.description as pet_description')
            ->join('users', 'periods.user_id', '=', 'users.id')
            ->join('pets', 'periods.pet_id', '=', 'pets.id')
            ->when($request->start_date != null, function ($query) use ($request){
                $query->where('periods.start_date', '>=', $request->start_date);
            })
            ->when($request->end_date != null, function ($query) use ($request){
                $query->where('periods.end_date', '<=', $request->end_date);
            })
            ->when($request->hourly_wage != null, function ($query) use ($request){
                $query->where('periods.hourly_wage', '>=', $request->hourly_wage);
            })
            ->when($request->difficulty != null, function ($query) use ($request){
                $query->where('pets.difficulty', '=', $request->difficulty);
            })
            ->when($request->type != null, function ($query) use ($request){
                $query->where('pets.type', '=', $request->type);
            })
            ->where('periods.assigned_to_id', null)
            ->get();

        $filterItems = array(
            (object) [
                'name' => 'start_date',
                'label' => 'Start Date',
                'type' => 'date',
            ],
            (object) [
                'name' => 'end_date',
                'label' => 'End Date',
                'type' => 'date',
            ],
            (object) [
                'name' => 'pet_type',
                'label' => 'Pet Type',
                'type' => 'text',
                ],
            (object) [
                'name' => 'hourly_wage',
                'label' => 'Hourly Wage',
                'type' => 'number',
                ],
            (object) [
                'name' => 'difficulty',
                'label' => 'Difficulty',
                'options' => ['Beginner Friendly', 'Novice', 'Experts Only'],
                ]
        );

        return view('periods.index', [
            'periods' => $periods,
            'pets' => Pet::with('user')->latest()->get(),
            'filterItems' => $filterItems,
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
