<?php

namespace App\Http\Controllers;

use App\Models\Education;
use App\Models\Resume;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        // Buscar o crear la entrada en la tabla 'education'
        $education = Education::firstOrCreate(
            [
                'institution' => $request->institution,
                'career' => $request->career,
                'type_of_study' => $request->type_of_study,
                'area_of_study' => $request->area_of_study,
                'subarea_of_study' => $request->subarea_of_study,
            ],
            [

            ]
        );

 
        $resumeId = auth()->user()->resume->id; 

        DB::table('education_resume')->updateOrInsert(
            [
                'resume_id' => $resumeId,
                'education_id' => $education->id
            ],
            [
                'status' => $request->status,
                'start_date' => $request->start_date,
                'finish_date' => $request->finish_date
            ]
        );

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
    public function destroy($educationResumeId)
{
    // Encuentra el registro de la tabla pivote 'education_resume' por su ID y elimínalo
    $pivot = DB::table('education_resume')->where('id', $educationResumeId)->delete();

    return redirect()->route('user-profile.index');
}
}
