<?php

namespace App\Http\Controllers;

use App\Models\Language;
use App\Models\Resume;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
    $languageName = $request->input('language_name');
    $written_level = $request->input('written_level');
    $oral_level = $request->input('oral_level');

    $resume = Resume::where('user_id', $user_id)->firstOrFail();

    // Busca si ya existe el idioma, si no, lo crea.
    $language = Language::firstOrCreate(['name' => $languageName]);

    // Asignar el idioma al currículum del usuario si aún no está asignado, junto con los niveles de habilidad.
    $languageEntry = $resume->languages()->find($language->id);
    if (!$languageEntry) {
        $resume->languages()->attach($language->id, [
            'written_level' => $written_level,
            'oral_level' => $oral_level
        ]);
    } else {
        // Si ya está asignado, pero deseas actualizar los niveles de habilidad, puedes usar updateExistingPivot
        $resume->languages()->updateExistingPivot($language->id, [
            'written_level' => $written_level,
            'oral_level' => $oral_level
        ]);
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
    public function destroy($languageId)
    {
        // Encuentra el registro de la tabla pivote por su ID y elimínalo
    $pivot = DB::table('language_resume')->where('id', $languageId)->delete();

    return redirect()->route('user-profile.index');
    }
}
