<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Education;
use App\Models\Language;
use App\Models\Skill;
use Illuminate\Support\Facades\DB;

class AutocompleteController extends Controller
{
    public function searchCareer(Request $request)
    {
        $search  = $request->get('term');
        $result  =  Education::where('career', 'LIKE', '%'. $search. '%')->select('career') // Selecciona solo la columna 'nombre'
        ->groupBy('career') // Agrupa por la columna 'nombre' para obtener entradas únicas
        ->take(10) // Limita a 10 resultados
        ->get();
        return response()->json($result);
    }

    public function searchTypeOfStudy(Request $request)
{
    $search = $request->get('term');
    $career = $request->get('career'); // Obtiene la carrera seleccionada
    $institution = $request->get('institution'); // Obtiene la institución seleccionada

    $query = Education::where('type_of_study', 'LIKE', '%' . $search . '%');

    if ($career) {
        $query->where('career', $career);
    }

    if ($institution) {
        $query->where('institution', $institution);
    }

    $result = $query->select('type_of_study')
                    ->groupBy('type_of_study')
                    ->take(10)
                    ->get();

    return response()->json($result);
}



    public function searchSkill(Request $request)
    {
        $search  = $request->get('term');
        $result  =  Skill::where('name', 'LIKE', '%'. $search. '%')->select('name') // Selecciona solo la columna 'nombre'
        ->groupBy('name') // Agrupa por la columna 'nombre' para obtener entradas únicas
        ->take(10) // Limita a 10 resultados
        ->get();
        return response()->json($result);
    }

    public function searchLanguage(Request $request)
    {
        $search  = $request->get('term');
        $result  =  Language::where('name', 'LIKE', '%'. $search. '%')->select('name') // Selecciona solo la columna 'nombre'
        ->groupBy('name') // Agrupa por la columna 'nombre' para obtener entradas únicas
        ->take(10) // Limita a 10 resultados
        ->get();
        return response()->json($result);
    }

    public function searchInstitution(Request $request)
{
    $search = $request->get('term');
    $career = $request->get('career'); // Obtiene el parámetro 'career', si está disponible

    $query = Education::where('institution', 'LIKE', '%'. $search .'%');

    if (!empty($career)) {
        // Filtra por carrera si se proporciona el parámetro
        $query->where('career', $career);
    }

    $result = $query->select('institution')
                    ->groupBy('institution')
                    ->take(10)
                    ->get();

    return response()->json($result);
}

public function searchArea(Request $request)
{
    $search = $request->get('term');
    $career = $request->get('career');
    $institution = $request->get('institution');
    $typeOfStudy = $request->get('type_of_study');

    $query = Education::where('area_of_study', 'LIKE', '%' . $search . '%');

    if ($career) {
        $query->where('career', $career);
    }
    if ($institution) {
        $query->where('institution', $institution);
    }
    if ($typeOfStudy) {
        $query->where('type_of_study', $typeOfStudy);
    }

    $result = $query->select('area_of_study')
                    ->groupBy('area_of_study')
                    ->get();

    return response()->json($result);
}

public function searchSubarea(Request $request)
{
    $search = $request->get('term');
    $career = $request->get('career');
    $institution = $request->get('institution');
    $typeOfStudy = $request->get('type_of_study');
    $areaOfStudy = $request->get('area_of_study');

    $query = Education::where('subarea_of_study', 'LIKE', '%' . $search . '%');

    if ($career) {
        $query->where('career', $career);
    }
    if ($institution) {
        $query->where('institution', $institution);
    }
    if ($typeOfStudy) {
        $query->where('type_of_study', $typeOfStudy);
    }
    if ($areaOfStudy) {
        $query->where('area_of_study', $areaOfStudy);
    }

    $result = $query->select('subarea_of_study')
                    ->groupBy('subarea_of_study')
                    ->take(10)
                    ->get();

    return response()->json($result);
}


    public function searchState(Request $request)
{
    $states = DB::table('regiones')
                ->select('id', 'region as name') // Utiliza 'region as name' para mantener la consistencia con el JS
                ->get()
                ->toArray();
    return response()->json($states);
}

public function searchProvince(Request $request)
{
    $regionId = $request->get('region_id');
    $provinces = DB::table('provincias')
                   ->where('region_id', $regionId)
                   ->select('id', 'provincia as name') // Cambia 'name' a 'provincia'
                   ->get()
                   ->toArray();
    return response()->json($provinces);
}

public function searchCity(Request $request)
{
    $provinceId = $request->get('province_id');
    $cities = DB::table('comunas')
                ->where('provincia_id', $provinceId)
                ->select('id', 'comuna as name') // Cambia 'name' a 'comuna'
                ->get()
                ->toArray();
    return response()->json($cities);
}

}
