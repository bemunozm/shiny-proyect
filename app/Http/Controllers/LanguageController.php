<?php

namespace App\Http\Controllers;

use App\Models\Language;
use App\Models\Resume;
use Illuminate\Http\Request;

class LanguageController extends Controller
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

        Language::create([
            'name' => $request->name,
            'written_level' => $request->written_level,
            'oral_level' => $request->oral_level,
            'resume_id' => $resume->id,
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
    public function destroy(string $id)
    {
        $var = Language::find($id);
        $var->delete();
        return redirect()->route('user-profile.index');
    }
}
