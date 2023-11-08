<?php

namespace App\Http\Controllers;

use App\Models\Resume;
use Illuminate\Http\Request;

class ResumeController extends Controller
{
    
    public function index()
    {
        $resumes = Resume::all();
        return view('laravel-examples.user-management', compact('resumes'));
    }

    public function userManagement(Request $request)
    {
    // Obtener los criterios de búsqueda desde la URL
    $country = $request->input('country');
    $typeOfStudy = $request->input('type_of_study');
    $skill = $request->input('skill');

    // Consulta base de datos para obtener los resultados filtrados
    $resumes = Resume::query()
        ->when($country, function ($query) use ($country) {
            $query->whereHas('user', function ($subquery) use ($country) {
                $subquery->where('country', 'like', '%' . $country . '%');
            });
        })
        ->when($typeOfStudy, function ($query) use ($typeOfStudy) {
            $query->whereHas('educations', function ($subquery) use ($typeOfStudy) {
                $subquery->where('career', 'like', '%' . $typeOfStudy . '%');
            });
        })
        ->when($skill, function ($query) use ($skill) {
            $query->whereHas('skills', function ($subquery) use ($skill) {
                $subquery->where('name', 'like', '%' . $skill . '%');
            });
        })
        ->get();

    // Renderizar la vista con los resultados filtrados
    return view('laravel-examples.user-management', compact('resumes'));
    }

    
    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }


    public function show(string $id)
    {
        //
    }

   
    public function edit(string $id)
    {
        //
    }

  
    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
