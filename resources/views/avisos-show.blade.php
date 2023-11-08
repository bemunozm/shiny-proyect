@extends('layouts.user_type.auth')

@section('content')
<form method="POST" action="{{route('replacement.update', $replacement)}}">
    @csrf
    @method('PUT')
    <input type="hidden" name="user_id" value="{{ auth()->id() }}">
    <h5 class="modal-title font-weight-normal" id="exampleModalLabel" >Informacion del aviso</h5>
    <div class="mb-3">
        <label for="job_name" class="form-label">¿Qué puesto quieres cubrir?</label>
        <input type="text" class="form-control" id="job_name" name="job_name" value="{{$replacement->job_name}}" required>
    </div>
    <div class="mb-3">
        <label for="job_area" class="form-label">Área del puesto</label>
        <input type="text" class="form-control" id="job_area" name="job_area" value="{{$replacement->job_area}}" required>
    </div>
    <div class="mb-3">
        <label for="job_sub_area" class="form-label">Subárea del puesto</label>
        <input type="text" class="form-control" id="job_sub_area" name="job_sub_area" value="{{$replacement->job_sub_area}}"required>
    </div>
    <div class="mb-3">
        <label for="jobLocation" class="form-label">¿Dónde se encuentra el lugar del trabajo?</label>
        <input type="text" class="form-control" id="country" name="country" placeholder="País" value="{{$replacement->country}}"required>
        <input type="text" class="form-control mt-2" id="state" name="state" placeholder="Región" value="{{$replacement->state}}" required>
        <input type="text" class="form-control mt-2" id="city" name="city" placeholder="Comuna" value="{{$replacement->city}}" required>
        <input type="text" class="form-control mt-2" id="address" name="address" placeholder="Dirección" value="{{$replacement->address}}" required>
    </div>
    <div class="mb-3">
        <label for="job_description" class="form-label">¿En qué consiste el puesto?</label>
        <textarea class="form-control" id="job_description" name="job_description" rows="3" required>{{$replacement->job_description}}</textarea>
    </div>
    
    <div class="mb-3">
        <label for="salaryRange" class="form-label">¿Cuál es el rango salarial bruto que ofreces?</label>
        <input type="number" class="form-control" id="min_salary" name="min_salary" placeholder="Mínimo" value="{{$replacement->min_salary}}" required>
        <input type="number" class="form-control mt-2" id="max_salary" name="max_salary" placeholder="Máximo" value="{{$replacement->max_salary}}" required>
    </div>
    <div class="mb-3">
        <label for="experience" class="form-label">¿Cuanto es el minimo de experiencia?</label>
        <input type="number" class="form-control" id="min_experience" name="min_experience" placeholder="Mínimo" value="{{$replacement->min_experience}}" required>
    </div>

    

    <div id="education-section"></div>

    
   
        <!-- Campo para el nombre del idioma -->
        <div id="language-section"></div>

    
    

    <div id="skills-section"></div>

    
    <div class="modal-footer">
        <a href="{{route('replacement.index')}}" class="btn bg-gradient-secondary" >Cerrar</a>
        <button type="submit" class="btn bg-gradient-primary">Crear Anuncio</button>
    </div>
</form>
@endsection

@section('scripts')
<script>
// Primero, carga los idiomas existentes
document.addEventListener('DOMContentLoaded', function() {
    // Suponiendo que tienes una variable `existingLanguages` que contiene los idiomas existentes
    var existingLanguages = @json($replacement->resume->languages);
    var languageSection = document.getElementById('language-section');

    existingLanguages.forEach(function(language, index) {
        addLanguageInput(language, index);
    });
    
    function addLanguageInput(language, index) {
        var html = `
            <div class="language-group" data-index="${index}">
                <h5>Idioma requerido</h5>
                <div class="mb-3">
                    <label class="form-label">Nombre del Idioma</label>
                    <input type="text" class="form-control" name="languages[${index}][name]" value="${language.name || ''}" placeholder="Escribe el nombre del idioma">
                    <input type="hidden" name="languages[${index}][id]" value="${language.id || ''}">
                </div>
                <div class="mb-3">
                    <label class="form-label">Nivel Escrito</label>
                    <select class="form-select" name="languages[${index}][written_level]">
                        <option value="Básico" ${language.written_level === 'Básico' ? 'selected' : ''}>Básico</option>
                        <option value="Intermedio" ${language.written_level === 'Intermedio' ? 'selected' : ''}>Intermedio</option>
                        <option value="Avanzado" ${language.written_level === 'Avanzado' ? 'selected' : ''}>Avanzado</option>
                        <option value="Nativo" ${language.written_level === 'Nativo' ? 'selected' : ''}>Nativo</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Nivel Oral</label>
                    <select class="form-select" name="languages[${index}][oral_level]">
                        <option value="Básico" ${language.oral_level === 'Básico' ? 'selected' : ''}>Básico</option>
                        <option value="Intermedio" ${language.oral_level === 'Intermedio' ? 'selected' : ''}>Intermedio</option>
                        <option value="Avanzado" ${language.oral_level === 'Avanzado' ? 'selected' : ''}>Avanzado</option>
                        <option value="Nativo" ${language.oral_level === 'Nativo' ? 'selected' : ''}>Nativo</option>
                    </select>
                </div>
                
            </div>
        `;
        languageSection.insertAdjacentHTML('beforeend', html);
    }
});

// Evento para agregar un nuevo idioma
document.getElementById('addLanguage').addEventListener('click', function() {
    var languageSection = document.getElementById('language-section');
    var index = languageSection.querySelectorAll('.language-group').length;
    addLanguageInput({}, index);
});

// Evento para eliminar un idioma
document.addEventListener('click', function(e) {
    if (e.target.classList.contains('remove-language')) {
        e.target.closest('.language-group').remove();
        // Actualizar los índices de los grupos de idiomas restantes
        updateIndices(document.querySelectorAll('.language-group'), 'languages');
    }
});

// Función para actualizar los índices
function updateIndices(groups, name) {
    groups.forEach(function(group, index) {
        var inputs = group.querySelectorAll('input, select');
        inputs.forEach(function(input) {
            var newName = input.name.replace(/\[(\d+)\]/, '[' + index + ']');
            input.name = newName;
        });
        group.setAttribute('data-index', index);
    });
}

</script>

<script>
    // Inicializar las secciones de educación y habilidades cuando el DOM esté listo
document.addEventListener('DOMContentLoaded', function() {
    // Cargar la educación existente
    var existingEducations = @json($replacement->resume->educations ?? []);
    var educationSection = document.getElementById('education-section');

    existingEducations.forEach(function(education, index) {
        addEducationInput(education, index);
    });

    // Cargar las habilidades existentes
    var existingSkills = @json($replacement->resume->skills ?? []);
    var skillsSection = document.getElementById('skills-section');

    existingSkills.forEach(function(skill, index) {
        addSkillInput(skill, index);
    });
});

// Función para agregar un nuevo grupo de educación
function addEducationInput(education, index) {
    var educationSection = document.getElementById('education-section');
    var html = `
        <div class="education-group">
            <h5>Información de Educación</h5>
            <!-- Título o Carrera -->
            <div class="mb-3">
                <label class="form-label">Título o Carrera</label>
                <input type="text" class="form-control" name="education[${index}][career]" value="${education.career || ''}" placeholder="Título o Carrera">
                <input type="hidden" name="education[${index}][id]" value="${education.id || ''}">
                
            </div>
            <!-- País -->
            <div class="mb-3">
                <label class="form-label">País</label>
                <input type="text" class="form-control" name="education[${index}][country]" value="${education.country || ''}" placeholder="País">
                
            </div>
            <!-- Tipo de Estudio -->
            <!-- ... campos adicionales ... -->
            
        </div>
    `;
    educationSection.insertAdjacentHTML('beforeend', html);
}

// Función para agregar un nuevo grupo de habilidad
function addSkillInput(skill, index) {
    var skillsSection = document.getElementById('skills-section');
    var html = `
        <div class="skill-group">
            <h5>Habilidad</h5>
            <div class="mb-3">
                <label class="form-label">Nombre de la Habilidad</label>
                <input type="text" class="form-control" name="skills[${index}][name]" value="${skill.name || ''}" placeholder="Introduce la habilidad">
                <input type="hidden" name="skills[${index}][id]" value="${skill.id || ''}">
            </div>
            
        </div>
    `;
    skillsSection.insertAdjacentHTML('beforeend', html);
}

// Eventos para agregar nuevos elementos
document.getElementById('addEducation').addEventListener('click', function() {
    var educationSection = document.getElementById('education-section');
    var index = educationSection.querySelectorAll('.education-group').length;
    addEducationInput({}, index);
});

document.getElementById('addSkill').addEventListener('click', function() {
    var skillsSection = document.getElementById('skills-section');
    var index = skillsSection.querySelectorAll('.skill-group').length;
    addSkillInput({}, index);
});

// Eventos para eliminar elementos y actualizar índices
document.addEventListener('click', function(e) {
    if (e.target.classList.contains('remove-education')) {
        e.target.closest('.education-group').remove();
        updateIndices(document.querySelectorAll('.education-group'), 'educations');
    } else if (e.target.classList.contains('remove-skill')) {
        e.target.closest('.skill-group').remove();
        updateIndices(document.querySelectorAll('.skill-group'), 'skills');
    }
});


    </script>
@endsection