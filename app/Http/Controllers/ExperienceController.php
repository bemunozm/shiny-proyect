<?php

namespace App\Http\Controllers;

use App\Models\Comuna;
use App\Models\Experience;
use App\Models\Provincia;
use App\Models\Region;
use App\Models\Resume;
use Illuminate\Http\Request;

class ExperienceController extends Controller
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
    public function store(Request $request)
    {
        
        $user_id = $request->input('user_id');
        $resume = Resume::where('user_id', $user_id)->first();

        $provinceName = Provincia::find($request->input('province_name'))->provincia;
        
        $stateName = Region::find($request->input('state_name'))->region;
        $cityName = Comuna::find($request->input('city_name'))->comuna;
        Experience::create([
            'company_name' => $request->company_name,
            'company_activity' => $request->company_activity,
            'job' => $request->job,
            'job_area' => $request->job_area,
            'job_sub_area' => $request->job_sub_area,
            'province' => $provinceName,
            'state' => $stateName,
            'city' => $cityName,
            'start_date' => $request->start_date,
            'finish_date' => $request->finish_date,
            'description' => $request->description,
            'person_in_charge' => $request->person_in_charge,
            'current' => $request->current,
            'resume_id' => $resume->id
        ]);

        return redirect()->route('user-profile.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $var = Experience::find($id);
        $var->delete();
        return redirect()->route('user-profile.index');
    }
}
