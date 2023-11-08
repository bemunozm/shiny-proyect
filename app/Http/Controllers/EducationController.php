<?php

namespace App\Http\Controllers;

use App\Models\Education;
use App\Models\Resume;
use Illuminate\Http\Request;

class EducationController extends Controller
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

        Education::create([
            'career' => $request->career,
            'country' => $request->country,
            'type_of_study' => $request->type_of_study,
            'area_of_study' => $request->area_of_study,
            'institution' => $request->institution,
            'status' => $request->status,
            'start_date' => $request->start_date,
            'finish_date' => $request->finish_date,
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
        $var = Education::find($id);
        $var->delete();
        return redirect()->route('user-profile.index');
    }
}
