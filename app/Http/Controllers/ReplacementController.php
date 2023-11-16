<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Comuna;
use App\Models\Education;
use App\Models\Replacement;
use App\Models\Language;
use App\Models\Provincia;
use App\Models\Region;
use App\Models\Resume;
use App\Models\Skill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ReplacementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user_id = auth()->id();
        $company = Company::where('user_id', $user_id)->first();
        if ($request->is('replacement')) {
            return view('avisos', compact('user_id', 'company'));
        } elseif ($request->is('tables')) {

            /////////
            $query = Replacement::query();

        // Filtros de búsqueda
        if ($request->filled('job_name')) {
            $query->where('job_name', 'like', '%' . $request->job_name . '%');
        }
        if ($request->filled('province')) {
            $query->where('province', $request->province);
        }
        if ($request->filled('state')) {
            $query->where('state', $request->state);
        }
        if ($request->filled('city')) {
            $query->where('city', $request->city);
        }

        $replacements = $query->get();

        // Pasar las colecciones adicionales si son necesarias para los dropdowns
        $countries = Replacement::distinct()->pluck('province');
        $states = Replacement::distinct()->pluck('state');
        $cities = Replacement::distinct()->pluck('city');

        return view('tables', compact('replacements', 'countries', 'states', 'cities', 'user_id'));
            /////////
        
        }
    }
        
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('crear-anuncio');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       
        $user_id = $request->input('user_id');
        $company = Company::where('user_id', $user_id)->firstOrFail();
    
        $provinceName = Provincia::find($request->input('province_name'))->provincia;
        
        $stateName = Region::find($request->input('state_name'))->region;
        $cityName = Comuna::find($request->input('city_name'))->comuna;
        
        
        
        $replacement = Replacement::create([
            'job_name' => $request->job_name,
            'job_area' => $request->job_area,
            'job_sub_area' => $request->job_sub_area,
            'province' => $provinceName,
            'state' => $stateName,
            'city' => $cityName,
            'address' => $request->address,
            'modality' => $request->modality,
            'job_description' => $request->job_description,
            'min_salary' => $request->min_salary,
            'max_salary' => $request->max_salary,
            'min_experience' => $request->min_experience,
            'experience_weight' => $request->experience_weight,
            'company_id' => $company->id
        ]);
    
            $resume = Resume::create([
                'replacement_id' => $replacement->id,
                // ... otros campos del resumen si existen ...
            ]);
    
            // Educación
            foreach ($request->input('education', []) as $educationData) {
                $education = Education::firstOrCreate([
                    'institution' => $educationData['institution'],
                    'career' => $educationData['career'],
                    'type_of_study' => $educationData['type_of_study'],
                    'area_of_study' => $educationData['area_of_study'],
                    'subarea_of_study' => $educationData['subarea_of_study'],
                ]);

                // ... otros campos del pivote si existen ...
                $resume->educations()->attach($education->id, [
                    'status' => $educationData['status'],
                    'weight' => $educationData['weight'],
                    // 'start_date' => $educationData['start_date'],
                    // 'finish_date' => $educationData['finish_date'],
                ]);
            }
            
    
            // Idiomas
            foreach ($request->input('languages', []) as $languageData) {
                $language = Language::firstOrCreate([
                    'name' => $languageData['name'],
                    // otros campos que definen de manera única el idioma
                ]);
            
                $resume->languages()->attach($language->id, [
                    'written_level' => $languageData['written_level'],
                    'oral_level' => $languageData['oral_level'],
                    'weight' => $languageData['weight'],
                ]);
            }
            
    
            // Habilidades
            foreach ($request->input('skills', []) as $skillData) {
                $skill = Skill::firstOrCreate([
                    'name' => $skillData['name'],
                    // otros campos que definen de manera única la habilidad
                ]);
            
                $resume->skills()->attach($skill->id, [
                    'weight' => $skillData['weight'], // Aquí se asigna la ponderación
                ]);
            }
            
    
            // Si todo fue exitoso, realiza el commit de la transacción
    
            return redirect()->route('company.index');
        }
    /**
     * Display the specified resource.
     */
    public function show(Request $request, $id)
    {
        $replacement = Replacement::with('resume.educations', 'resume.skills', 'resume.languages')->find($id);

        if ($request->routeIs('ver.empleo')) {
            
            return view('ver-empleo', compact('replacement'));
        }
        else {
            return view('avisos-show', compact('replacement'));
        }
        
    }
    public function buscarEmpleos(Request $request)
    {
        // Obtener los criterios de búsqueda desde la URL
        $jobArea = $request->input('job_area');
        $country = $request->input('country');
        $state = $request->input('state');
        $city = $request->input('city');
    
        // Consulta base de datos para obtener los resultados filtrados
        $replacements = Replacement::query()
            ->when($jobArea, function ($query) use ($jobArea) {
                $query->where('job_area', 'like', '%' . $jobArea . '%');
            })
            ->when($country, function ($query) use ($country) {
                $query->where('country', 'like', '%' . $country . '%');
            })
            ->when($state, function ($query) use ($state) {
                $query->where('state', 'like', '%' . $state . '%');
            })
            ->when($city, function ($query) use ($city) {
                $query->where('city', 'like', '%' . $city . '%');
            })
            ->get();
    
        // Renderizar la vista con los resultados filtrados
        return view('tables', compact('replacements'));
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
    public function update(Request $request, $id)
{
    $replacement = Replacement::findOrFail($id);
    $provinceName = Provincia::find($request->input('province_name'))->provincia;
    $stateName = Region::find($request->input('state_name'))->region;
    $cityName = Comuna::find($request->input('city_name'))->comuna;

    $replacementData = [
        'job_name' => $request->job_name,
        'job_area' => $request->job_area,
        'job_sub_area' => $request->job_sub_area,
        'province' => $provinceName,
        'state' => $stateName,
        'city' => $cityName,
        'address' => $request->address,
        'job_description' => $request->job_description,
        'min_salary' => $request->min_salary,
        'max_salary' => $request->max_salary,
        'min_experience' => $request->min_experience,
    ];

    // Actualiza los datos del Replacement
    $replacement->update($replacementData);

    $resume = $replacement->resume;

    // Actualiza education
    foreach ($request->education as $educationData) {
        $education = Education::firstOrCreate([
            'institution' => $educationData['institution'],
            'career' => $educationData['career'],
            'type_of_study' => $educationData['type_of_study'],
            'area_of_study' => $educationData['area_of_study'],
            'subarea_of_study' => $educationData['subarea_of_study'],
        ]);

        // Obtén la id del education (ya sea existente o recién creado)
        $educationId = $education->id;

        // Busca la combinación de education y resume
        $resumeEducation = $resume->educations()
            ->wherePivot('education_id', $educationId)
            ->first();

        // Asigna o actualiza los datos de pivote
        if ($resumeEducation) {
            $resumeEducation->pivot->update([
                'status' => $educationData['status'],
                // Agrega otros campos de pivote si es necesario
            ]);
        } else {
            // Si no existe la combinación, crea la relación de pivote
            $resume->educations()->attach($educationId, [
                'status' => $educationData['status'],
                // Agrega otros campos de pivote si es necesario
            ]);
        }
    }

    // Actualiza languages
    foreach ($request->languages as $languageData) {
        $language = Language::firstOrCreate([
            'name' => $languageData['name'],
            // Otros campos que definen de manera única el idioma
        ]);

        // Obtén la id del language (ya sea existente o recién creado)
        $languageId = $language->id;

        // Busca la combinación de language y resume
        $resumeLanguage = $resume->languages()
            ->wherePivot('language_id', $languageId)
            ->first();

        // Asigna o actualiza los datos de pivote
        if ($resumeLanguage) {
            $resumeLanguage->pivot->update([
                'written_level' => $languageData['written_level'],
                'oral_level' => $languageData['oral_level'],
                // Agrega otros campos de pivote si es necesario
            ]);
        } else {
            // Si no existe la combinación, crea la relación de pivote
            $resume->languages()->attach($languageId, [
                'written_level' => $languageData['written_level'],
                'oral_level' => $languageData['oral_level'],
                // Agrega otros campos de pivote si es necesario
            ]);
        }
    }

    // Actualiza skills
    foreach ($request->skills as $skillData) {
        $skill = Skill::firstOrCreate([
            'name' => $skillData['name'],
            // Otros campos que definen de manera única la habilidad
        ]);

        // Obtén la id del skill (ya sea existente o recién creado)
        $skillId = $skill->id;

        // Verifica si el skill ya está relacionado con el resume
        if (!$resume->skills->contains($skillId)) {
            // Si no está relacionado, crea la relación
            $resume->skills()->attach($skillId);
        }
        // No hay datos de pivote adicionales mencionados para habilidades
    }

    return redirect()->route('replacement.index')->with('success', 'Replacement actualizado con éxito');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
{
    // Encontrar el Replacement junto con su Resume asociado
    $replacement = Replacement::with('resume.languages', 'resume.skills', 'resume.educations')->find($id);

    if ($replacement) {
        // Si el Replacement tiene un Resume asociado, eliminar sus relaciones
        if ($replacement->resume) {
            $replacement->resume->languages()->detach();
            $replacement->resume->skills()->detach();

            // Para Educations, si es una relación uno a muchos, utiliza delete()
            // Si es muchos a muchos, utiliza detach()
            $replacement->resume->educations()->detach(); // o detach(), según tu modelo de datos

            // Después de eliminar las relaciones, eliminar el Resume
            $replacement->resume->delete();
        }

        // Finalmente, eliminar el Replacement
        $replacement->delete();

        return redirect()->route('replacement.index')->with('success', 'Registro borrado correctamente!');
    } else {
        // Si el Replacement no existe
        return redirect()->route('replacement.index')->with('error', 'El registro no existe.');
    }
}

    public function destroyApplication($replacementId)
{
    $userId = auth()->id();
    $resume = Resume::where('user_id', $userId)->firstOrFail();
    $resume->replacements()->detach($replacementId);

    return redirect()->back()->with('success', 'Postulación eliminada correctamente.');
}

    public function mostrar($id){
        $replacement = Replacement::with(['resumes.user', 'resumes.languages', 'resumes.skills', 'resumes.educations'])->find($id);
        
        
        if (!$replacement || !$replacement->resume) {
            // Manejar el caso de que no haya un resume ideal
            // Puedes decidir redirigir a una página de error o lanzar una excepción
            abort(403, 'El perfil ideal para la sustitución no se encuentra.');
        }
    
        
        // Asumimos que el replacement tiene un resume que define el criterio ideal.
        $idealResume = $replacement->resume; // Asumimos que esta relación está definida en el modelo.
        $maximumScore = $this->calculateMaximumScore($idealResume);
        
        $sortedResumes = $replacement->resumes->map(function ($resume) use ($idealResume) {
            // Comparar el resume con el idealResume y calcular un puntaje de afinidad.
            $affinityScore = $this->calculateAffinityScore($resume, $idealResume);
            
            // Agregar el puntaje al objeto resume para poder ordenar después.
            $resume->affinityScore = $affinityScore;
            
            return $resume;
        })->sortByDesc('affinityScore');

        // Retornar la vista con los resumes ordenados por afinidad
        return view('remplazos', ['replacement' => $replacement, 'sortedResumes' => $sortedResumes, 'maximumScore' => $maximumScore]);
    }

    private function calculateMaximumScore($idealResume) {
        $maxScore = 0;
        
        // Supongamos que la experiencia tiene una puntuación máxima de 10, ajusta según tu aplicación
        $maxScore += 12 * $idealResume->experience_weight;
        
        switch ($idealResume->replacement->modality) {
            case 'Presencial':
                $maxScore += 2;
                $maxScore += 4;
                $maxScore += 6;
                break;
            case 'Virtual':
                // Sin puntaje para virtual
                $maxScore += 0;
                break;
            case 'Hibrido':
                // Mitad de puntaje para híbrido
                $maxScore += 1;
                $maxScore += 2;
                $maxScore += 3;
                break;
        }
        
        // Puntuación máxima por idiomas
        foreach ($idealResume->languages as $language) {
            $weight = $language->pivot->weight;
            // Supongamos que cada idioma tiene una puntuación máxima de 15, ajusta según tu aplicación
            $maxScore += 13 * $weight;
        }
        
        // Puntuación máxima por habilidades
        foreach ($idealResume->skills as $skill) {
            $weight = $skill->pivot->weight;
            // Supongamos que cada habilidad tiene una puntuación máxima de 5, ajusta según tu aplicación
            $maxScore += 12 * $weight;
        }
        
        // Puntuación máxima por educación
        foreach ($idealResume->educations as $education) {
            $weight = $education->pivot->weight;
            // Supongamos que cada criterio educativo tiene una puntuación máxima de 10, ajusta según tu aplicación
            $maxScore += 12 * $weight;
        }
        
        return $maxScore;
    }
    
    private function calculateAffinityScore($resume, $idealResume) {
        $score = 0;
    
        
        if ($idealResume->replacement->min_experience > 0 && ($resume->experiences->isNotEmpty())) {
            
            foreach ($resume->experiences as $experience) { 
                
                similar_text(strtolower($experience->job_area), strtolower($idealResume->replacement->job_area), $percent);
                if ($percent >= 80) {
                    
                    $startDateStr = $experience->start_date;
                    $finishDateStr = $experience->finish_date;
        
                    $startDate = \Carbon\Carbon::parse($startDateStr);
                    $finishDate = \Carbon\Carbon::parse($finishDateStr);
        
                    if ($startDate && $finishDate) {
                        $monthsDifference = $startDate->diffInMonths($finishDate);
                        if ($monthsDifference >= $idealResume->replacement->min_experience) {
                            // Aquí se multiplica la puntuación base por la ponderación de la experiencia
                            $score += 3   * ($idealResume->experience_weight);
                        }
                    }
                } elseif ($percent >= 60 && $percent < 80) {
                    
                    $startDate = $experience->start_date;
                    $finishDate = $experience->finish_date;
        
                    if ($startDate && $finishDate) {
                        $monthsDifference = $startDate->diffInMonths($finishDate);
                        if ($monthsDifference >= $idealResume->replacement->min_experience) {
                            // Igualmente, se multiplica la puntuación base por la ponderación de la experiencia
                            $score += 6 * ($idealResume->experience_weight);
                        }
                    }
                } elseif ($resume->experiences->isEmpty() && ($idealResume->replacement->min_experience > 0)) {
                    
                    $score -= 3 * ($idealResume->replacement->experience_weight); 
                }
            }
                
            }
        
        

        switch ($idealResume->replacement->modality) {
            case 'Presencial':
                $score += (strtolower($resume->user->state) == strtolower($idealResume->replacement->state)) ? 2 : 0;
                $score += (strtolower($resume->user->province) == strtolower($idealResume->replacement->province)) ? 4 : 0;
                $score += (strtolower($resume->user->city) == ($idealResume->replacement->city)) ? 6 : 0;
                break;
            case 'Virtual':
                // Sin puntaje para virtual
                $score += 0;
                break;
            case 'Hibrido':
                // Mitad de puntaje para híbrido
                $score += (strtolower($resume->user->state) == strtolower($idealResume->replacement->state)) ? 1 : 0;
                $score += (strtolower($resume->user->province) == strtolower($idealResume->replacement->province)) ? 2 : 0;
                $score += (strtolower($resume->user->city) == ($idealResume->replacement->city)) ? 3 : 0;
                break;
        }
        // Compara lenguajes, habilidades y educación.
        
        $score += $this->compareLanguages($resume->languages, $idealResume->languages);
        $score += $this->compareSkills($resume->skills, $idealResume->skills);
        $score += $this->compareEducation($resume->educations, $idealResume->educations);
    
            return $score;
    }
    
    private function compareLanguages($candidateLanguages, $idealLanguages) {
        
        $score = 0;
        $baseScore = 0;
        $extraScoreForExactMatch = 0;
        $extraScoreForHigherLevel = 0;

        foreach ($idealLanguages as $idealLanguage) {
            $weight = $idealLanguage->pivot->weight;
            foreach ($candidateLanguages as $candidateLanguage) {
                // Compara si los nombres de los idiomas son iguales
                if (strtolower($idealLanguage->name) == strtolower($candidateLanguage->name)) {
                    $baseScore += 7; // Puntuación base por coincidencia de nombre
                    
                    // Puntuación adicional por coincidencia exacta de nivel
                    if ($candidateLanguage->pivot->written_level == $idealLanguage->pivot->written_level &&
                        $candidateLanguage->pivot->oral_level == $idealLanguage->pivot->oral_level) {
                        $extraScoreForExactMatch += 5; // Ajusta el 5 al valor que desees para coincidencia exacta
                    }
                    
                    // Puntuación adicional por niveles superiores
                    if ($this->languageLevelHigherThan($candidateLanguage->pivot->written_level, $idealLanguage->pivot->written_level) &&
                        $this->languageLevelHigherThan($candidateLanguage->pivot->oral_level, $idealLanguage->pivot->oral_level)) {
                        $extraScoreForHigherLevel += 6; // Ajusta el 7 al valor que desees para niveles superiores
                    }
                }
                $score = ($baseScore + $extraScoreForExactMatch + $extraScoreForHigherLevel) * $weight;
            }
        }
        
        return $score;
    }
    

    function languageLevelHigherThan($level1, $level2) {
        // Define el orden de los niveles de habilidad desde el más bajo al más alto
        $levels = [
            'Basico' => 1,
            'Intermedio' => 2,
            'Avanzado' => 3,
            'Nativo' => 4
        ];
    
        // Compara los niveles utilizando el mapeo definido
        return $levels[$level1] > $levels[$level2];
    }
    
    private function compareSkills($candidateSkills, $idealSkills) {
        $score = 0;
        foreach ($idealSkills as $idealSkill) {
            $weight = $idealSkill->pivot->weight;
            foreach ($candidateSkills as $candidateSkill) {
                

                $score += (strcasecmp($candidateSkill->name, $idealSkill->name) == 0 ? 12 : 0)*$weight;
            }
        }

        return $score;
    }
    
    private function compareEducation($candidateEducation, $idealEducation) {
        $score = 0;
    
        foreach ($idealEducation as $idealEdu) {
            $weight = $idealEdu->pivot->weight;
            foreach ($candidateEducation as $candidateEdu) {
                
                similar_text(strtolower($candidateEdu->career), strtolower($idealEdu->career), $percentCareer);
            if ($percentCareer >= 60) {
                $baseScore = ($percentCareer >= 80) ? 6 : 3;
                $score += $baseScore ;
            }

            
            if (strcasecmp($candidateEdu->type_of_study, $idealEdu->type_of_study) == 0) {
                $score += 2 ; 
            }

            // Compara el área de estudio
            if (strcasecmp($candidateEdu->area_of_study, $idealEdu->area_of_study) == 0) {
                $score += 2 ; 
            }

            // Compara la subárea de estudio
            if (strcasecmp($candidateEdu->subarea_of_study, $idealEdu->subarea_of_study) == 0) {
                $score += 2; 
            }

            }
            $score = $score * $weight;
        }
        return $score;
    }
    

    public function asignar($replacement_id){
        $user_id = auth()->id();

        $resume = Resume::where('user_id', $user_id)->first();

        
        $replacement = Replacement::find($replacement_id);

        if ($replacement->resumes()->where('resume_id', $resume->id)->exists()) {
            // Manejar el caso en que la relación ya existe, por ejemplo, con un mensaje de error.
            return back()->with('alert-error', 'El currículum ya está asignado a este empleo.');
        }
        $replacement->resumes()->attach($resume->id);

        return redirect()->route('empleos.buscar')->with('success', 'El currículum ha sido asignado al empleo exitosamente.');
    }
}
