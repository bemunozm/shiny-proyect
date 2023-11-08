<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Education;
use App\Models\Replacement;
use App\Models\Language;
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
        if ($request->filled('country')) {
            $query->where('country', $request->country);
        }
        if ($request->filled('state')) {
            $query->where('state', $request->state);
        }
        if ($request->filled('city')) {
            $query->where('city', $request->city);
        }

        $replacements = $query->get();

        // Pasar las colecciones adicionales si son necesarias para los dropdowns
        $countries = Replacement::distinct()->pluck('country');
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
    
        // Inicia una transacción para asegurarte de que todas las operaciones se completen con éxito o ninguna.
        
        
        
            $replacement = Replacement::create([
                'job_name' => $request->job_name,
                'job_area' => $request->job_area,
                'job_sub_area' => $request->job_sub_area,
                'country' => $request->country,
                'state' => $request->state,
                'city' => $request->city,
                'address' => $request->address,
                'job_description' => $request->job_description,
                'min_salary' => $request->min_salary,
                'max_salary' => $request->max_salary,
                'min_experience' => $request->min_experience,
                'company_id' => $company->id
            ]);
    
            $resume = Resume::create([
                'replacement_id' => $replacement->id,
                // ... otros campos del resumen si existen ...
            ]);
    
            // Educación
            foreach ($request->input('education', []) as $educationData) {
                // Asegúrate de validar y limpiar $educationData antes de insertarlo en la base de datos.
                Education::create([
                    'career' => $educationData['career'],
                    'type_of_study' => $educationData['type_of_study'],
                    'status' => $educationData['status'],
                    'resume_id' => $resume->id
                ]);
            }
            
    
            // Idiomas
            foreach ($request->input('languages', []) as $languageData) {
                Language::create([
                    'name' => $languageData['name'],
                    'written_level' => $languageData['written_level'],
                    'oral_level' => $languageData['oral_level'],
                    'resume_id' => $resume->id
                ]);
            }
            
    
            // Habilidades
            foreach ($request->input('skills', []) as $skillData) {
                Skill::create([
                    'name' => $skillData['name'],
                    // Agrega el resto de campos aquí si los hay.
                    'resume_id' => $resume->id
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
        $replacement = Replacement::find($id);
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
            
            $replacement->update($request->only([
                'job_name',
                'job_area',
                'job_sub_area',
                'country',
                'state',
                'city',
                'address',
                'job_description',
                'min_salary',
                'max_salary',
                'min_experience'
            ]));
    
            $resume = $replacement->resume; // Asumiendo que hay una relación directa replacement->resume
    
            $resume = $replacement->resume; // Asumiendo que hay una relación directa replacement->resume

            // Actualiza education
            foreach ($request->education as $educationData) { // Corregido a 'education'
                if (isset($educationData['id'])) {
                    $resume->educations()->updateOrCreate(
                        ['id' => $educationData['id']], // Asegurándose de que el 'id' esté establecido
                        $educationData
                    );
                }
            }
        
            // Actualiza languages
            foreach ($request->languages as $languageData) {
                if (isset($languageData['id'])) {
                    $resume->languages()->updateOrCreate(
                        ['id' => $languageData['id']],
                        $languageData
                    );
                }
            }
        
            // Actualiza skills
            foreach ($request->skills as $skillData) {
                if (isset($skillData['id'])) {
                    $resume->skills()->updateOrCreate(
                        ['id' => $skillData['id']],
                        $skillData
                    );
                }
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
            $replacement->resume->languages()->delete();
            $replacement->resume->skills()->delete();
            $replacement->resume->educations()->delete();

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
    
        $sortedResumes = $replacement->resumes->map(function ($resume) use ($idealResume) {
            // Comparar el resume con el idealResume y calcular un puntaje de afinidad.
            $affinityScore = $this->calculateAffinityScore($resume, $idealResume);
            
            // Agregar el puntaje al objeto resume para poder ordenar después.
            $resume->affinityScore = $affinityScore;
            
            return $resume;
        })->sortByDesc('affinityScore');
    
        // Retornar la vista con los resumes ordenados por afinidad
        return view('remplazos', ['replacement' => $replacement, 'sortedResumes' => $sortedResumes]);
    }
    
    private function calculateAffinityScore($resume, $idealResume) {
        $score = 0;
    
        // Incrementa el puntaje si el área de trabajo, sub área, país, estado y ciudad coinciden.
        //$score += ($resume->user->job_area == $idealResume->job_area) ? 10 : 0;
        //$score += ($resume->user->job_sub_area == $idealResume->job_sub_area) ? 5 : 0;
        if ($resume->experiences->isNotEmpty()){
        foreach ($resume->experiences as $experience) {
            similar_text(strtolower($experience->job_area), strtolower($idealResume->replacement->job_area), $percent);
            if($percent >= 80){
                
                $startDateStr = $experience->start_date;
                $finishDateStr = $experience->finish_date;

                $startDate = \Carbon\Carbon::parse($startDateStr);
                $finishDate = \Carbon\Carbon::parse($finishDateStr);

                if ($startDate && $finishDate) {
                    $monthsDifference = $startDate->diffInMonths($finishDate);

                    // Comparar la diferencia en meses con la experiencia mínima deseada
                    if ($monthsDifference >= $idealResume->replacement->min_experience) {

                        
                        $score = $score + 3 + ($monthsDifference - $idealResume->replacement->min_experience);
                    }
                }
            }
            elseif($percent >= 60 && $percent<80){
                
                $startDate = $experience->start_date;
                $finishDate = $experience->finish_date;

                if ($startDate && $finishDate) {
                    $monthsDifference = $startDate->diffInMonths($finishDate);

                    // Comparar la diferencia en meses con la experiencia mínima deseada
                    if ($monthsDifference >= $idealResume->replacement->min_experience) {
                        $score += 2;
                    }
                }
            }
        }
    }
    elseif($resume->experiences->isEmpty()){
        $score -= 3;
    }

        $score += (strtolower($resume->user->country) == strtolower($idealResume->country)) ? 3 : 0;
        $score += (strtolower($resume->user->state) == strtolower($idealResume->state)) ? 2 : 0;
        $score += (strtolower($resume->user->city) == ($idealResume->city)) ? 1 : 0;
    
        // Compara lenguajes, habilidades y educación.
        $score += $this->compareLanguages($resume->languages, $idealResume->languages);
        $score += $this->compareSkills($resume->skills, $idealResume->skills);
        $score += $this->compareEducation($resume->educations, $idealResume->educations);
    
        return $score;
    }
    
    private function compareLanguages($candidateLanguages, $idealLanguages) {
        $score = 0;
        foreach ($idealLanguages as $idealLanguage) {
            foreach ($candidateLanguages as $candidateLanguage) {
                if (preg_match("/".preg_quote($idealLanguage->name, '/')."/i", $candidateLanguage->name)) {
                    
                    $score = 3;

                    

                    if ($this->languageLevelHigherThan($candidateLanguage->written_level, $idealLanguage->written_level)) {
                        
                        $score += 2;
                    } else if ($candidateLanguage->written_level == $idealLanguage->written_level) {
                        
                        $score += 1;
                    }

                    if ($this->languageLevelHigherThan($candidateLanguage->oral_level, $idealLanguage->oral_level)) {
                        
                        $score += 2;
                    } else if ($candidateLanguage->oral_level == $idealLanguage->oral_level) {
                        
                        $score += 1;
                    }


                                }
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
            foreach ($candidateSkills as $candidateSkill) {
                if ($candidateSkill->name == $idealSkill->name) {
                    $score += 2; // Supongamos que cada habilidad coincide vale 5 puntos.
                }
                elseif (strpos($candidateSkill->name, $idealSkill->name) !== false || strpos($idealSkill->name,$candidateSkill->name) !== false) {
                    $score += 1;
                }
            }
        }
        return $score;
    }
    
    private function compareEducation($candidateEducation, $idealEducation) {
        $score = 0;
        
        foreach ($idealEducation as $idealEdu) {
            foreach ($candidateEducation as $candidateEdu) {
                similar_text(strtolower($candidateEdu->career), strtolower($idealEdu->career), $percentcareer);
                if($percentcareer == 100){
                    if($candidateEdu->type_of_study == $idealEdu->type_of_study && $candidateEdu->status == $idealEdu->status){
                        $score += 10;
                    }
                    elseif($candidateEdu->type_of_study == $idealEdu->type_of_study){
                        $score += 7;
                    }
                    else{
                        $score += 8;
                    }
                }
                elseif($percentcareer>=80){
                    if($candidateEdu->type_of_study == $idealEdu->type_of_study && $candidateEdu->status == $idealEdu->status){
                        $score += 7;
                    }
                    elseif($candidateEdu->type_of_study == $idealEdu->type_of_study){
                        $score += 6;
                    }
                    else{
                        $score += 5;
                    }
                }
                elseif($percentcareer>=60 && $percentcareer<80){
                    if($candidateEdu->type_of_study == $idealEdu->type_of_study && $candidateEdu->status == $idealEdu->status){
                        $score += 4;
                    }
                    elseif($candidateEdu->type_of_study == $idealEdu->type_of_study){
                        $score += 3;
                    }
                    else{
                        $score += 2;
                    }
                }

                
            }
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
