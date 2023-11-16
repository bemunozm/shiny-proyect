<?php

namespace App\Http\Controllers;

use App\Models\Resume;
use App\Models\Skill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SkillController extends Controller
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
    $skillName = $request->input('skill_name');

    $resume = Resume::where('user_id', $user_id)->firstOrFail();

    // Busca si ya existe la habilidad, si no, la crea.
    $skill = Skill::firstOrCreate(['name' => $skillName]);

    // Asignar la habilidad al currículum del usuario si aún no está asignada.
    if (!$resume->skills()->find($skill->id)) {
        $resume->skills()->attach($skill->id);
    }

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
        // Encuentra el registro de la tabla pivote por su ID y elimínalo
        $pivot = DB::table('resume_skill')->where('id', $id)->delete();

        return redirect()->route('user-profile.index');
    }

}
