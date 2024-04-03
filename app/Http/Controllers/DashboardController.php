<?php

namespace App\Http\Controllers;

use App\Models\Period;
use App\Models\Review;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use function PHPUnit\Framework\isNull;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $user_id = auth()->user()->id;
        return view('dashboard.dashboard', [
            'periods_current' => Period::where('user_id', $user_id)->where('end_date', '>=' , date('Y-m-d'))->get(),
            'jobs_current' => Period::where('assigned_to_id', $user_id)->where('end_date', '>=' , date('Y-m-d'))->get(),
            'reviews' => DB::table('reviews')
                ->select('reviews.id', 'reviews.rating', 'reviews.review', 'users.name', 'users.image', 'users.id as user_id', 'periods.start_date as start_date', 'periods.end_date as end_date', 'pets.name as pet')
                ->join('periods', 'reviews.period_id', '=', 'periods.id')
                ->join('users', 'periods.assigned_to_id', '=', 'users.id')
                ->join('pets', 'periods.pet_id', '=', 'pets.id')
                ->where('periods.assigned_to_id', '!=', null)
                ->where('periods.end_date', '<', date('Y-m-d'))
                ->where('reviews.rating', '=', null)
                ->get()
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
        //
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
    public function update(Request $request): RedirectResponse
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        //
    }

    public function assignTo(Request $request): RedirectResponse
    {

        //
    }

}
