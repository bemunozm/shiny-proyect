@extends('layouts.user_type.auth')

@section('content')
<form method="POST" action="{{route('replacement.store')}}">
    @csrf
    <input type="hidden" name="user_id" value="{{ auth()->id() }}">
    <h5 class="modal-title font-weight-normal" id="exampleModalLabel">Informacion del aviso</h5>
    <div class="mb-3">
        <label for="job_name" class="form-label">¿Qué puesto quieres cubrir?</label>
        <input type="text" class="form-control" id="job_name" name="job_name" required>
    </div>
    <div class="mb-3">
        <label for="job_area" class="form-label">Área del puesto</label>
        <input type="text" class="form-control" id="job_area" name="job_area" required>
    </div>
    <div class="mb-3">
        <label for="job_sub_area" class="form-label">Subárea del puesto</label>
        <input type="text" class="form-control" id="job_sub_area" name="job_sub_area" required>
    </div>
    <div class="mb-3">
        <label for="jobLocation" class="form-label">¿Dónde se encuentra el lugar del trabajo?</label>
        <input type="text" class="form-control" id="country" name="country" placeholder="País" required>
        <input type="text" class="form-control mt-2" id="state" name="state" placeholder="Región" required>
        <input type="text" class="form-control mt-2" id="city" name="city" placeholder="Comuna" required>
        <input type="text" class="form-control mt-2" id="address" name="address" placeholder="Dirección" required>
    </div>
    <div class="mb-3">
        <label for="job_description" class="form-label">¿En qué consiste el puesto?</label>
        <textarea class="form-control" id="job_description" name="job_description" rows="3" required></textarea>
    </div>
    <div class="mb-3">
        <label for="salaryRange" class="form-label">¿Cuál es el rango salarial bruto que ofreces?</label>
        <input type="number" class="form-control" id="min_salary" name="min_salary" placeholder="Mínimo" required>
        <input type="number" class="form-control mt-2" id="max_salary" name="max_salary" placeholder="Máximo" required>
    </div>
    <div class="mb-3">
        <label for="experience" class="form-label">¿Cuanto es el minimo de experiencia?</label>
        <input type="number" class="form-control" id="min_experience" name="min_experience" placeholder="Mínimo" required>
    </div>

        <!-- Botón para agregar educación -->
    <button type="button" id="addEducation" class="btn btn-primary">Agregar Estudios requeridos</button>

    <div id="education-section"></div>

    
    <!-- Botón para agregar un nuevo idioma -->
    <button type="button" class="btn btn-primary" id="addLanguage">Agregar Idiomas requerido</button>
        <!-- Campo para el nombre del idioma -->
        <div id="language-section"></div>

    
    <button type="button" id="addSkill" class="btn btn-primary">Agregar Habilidad</button>

    <div id="skills-section"></div>


    <div class="modal-footer">
        <a href="{{route('replacement.index')}}" class="btn bg-gradient-secondary" >Cerrar</a>
        <button type="submit" class="btn bg-gradient-primary">Crear Anuncio</button>
    </div>
</form>
@endsection

@section('scripts')
<script>
document.getElementById('addLanguage').addEventListener('click', function() {
    var languageSection = document.getElementById('language-section');
    var index = languageSection.getElementsByClassName('language-group').length; // Obtiene el índice para el nuevo grupo de idiomas

    var html = `
        <div class="language-group">
            <h5>Idioma requerido</h5>
            <div class="mb-3">
                <label class="form-label">Nombre del Idioma</label>
                <input type="text" class="form-control" name="languages[${index}][name]" placeholder="Escribe el nombre del idioma">
            </div>
            <div class="mb-3">
                <label class="form-label">Nivel Escrito</label>
                <select class="form-select" name="languages[${index}][written_level]">
                    <option value="Basico">Básico</option>
                    <option value="Intermedio">Intermedio</option>
                    <option value="Avanzado">Avanzado</option>
                    <option value="Nativo">Nativo</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Nivel Oral</label>
                <select class="form-select" name="languages[${index}][oral_level]">
                    <option value="Basico">Básico</option>
                    <option value="Intermedio">Intermedio</option>
                    <option value="Avanzado">Avanzado</option>
                    <option value="Nativo">Nativo</option>
                </select>
            </div>
            <button type="button" class="btn btn-danger remove-language">Eliminar idioma</button>
        </div>
    `;

    languageSection.insertAdjacentHTML('afterbegin', html); // Asegúrate de que es 'beforeend' para mantener el orden
});


// Agregar evento para eliminar el grupo de idioma
document.addEventListener('click', function(e) {
    if (e.target.classList.contains('remove-language')) {
        e.target.closest('.language-group').remove();
    }
});
</script>

<script>
    document.getElementById('addEducation').addEventListener('click', function() {
    var educationSection = document.getElementById('education-section');
    var index = document.querySelectorAll('.education-group').length;

    var html = `
        <div class="education-group">
            <h5>Información de Educación</h5>
            <!-- Título o Carrera -->
            <div class="mb-3">
                <label class="form-label">Título o Carrera</label>
                <input type="text" class="form-control" name="education[${index}][career]" placeholder="Título o Carrera">
            </div>
            <!-- País -->
            <div class="mb-3">
                <label class="form-label">Tipo de estudio</label>
                <select class="form-select" name="education[${index}][type_of_study]">
                    <option value="Tecnico">Tecnico</option>
                    <option value="Pregrado">Pregrado</option>
                    <option value="Maestría">Maestria</option>
                    <option value="Doctorado">Doctorado</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Tipo de estudio</label>
                <select class="form-select" name="education[${index}][status]">
                    <option value="En Curso">En Curso</option>
                    <option value="Finalizado">Finalizado</option>
                    
                </select>
            </div>
            <!-- Tipo de Estudio -->
            <!-- ... campos adicionales ... -->
            <button type="button" class="btn btn-danger remove-education">Eliminar Educación</button>
        </div>
    `;

    educationSection.insertAdjacentHTML('afterbegin', html);
});

// Agregar evento para eliminar el grupo de educación
document.addEventListener('click', function(e) {
    if (e.target.classList.contains('remove-education')) {
        e.target.closest('.education-group').remove();
    }
});
document.getElementById('addSkill').addEventListener('click', function() {
    var skillsSection = document.getElementById('skills-section');
    var index = document.querySelectorAll('.skill-group').length;

    var html = `
        <div class="skill-group">
            <h5>Habilidad</h5>
            <div class="mb-3">
                <label class="form-label">Nombre de la Habilidad</label>
                <input type="text" class="form-control" name="skills[${index}][name]" placeholder="Introduce la habilidad">
            </div>
            <button type="button" class="btn btn-danger remove-skill">Eliminar Habilidad</button>
        </div>
    `;

    skillsSection.insertAdjacentHTML('afterbegin', html);
});

// Agregar evento para eliminar el grupo de habilidades
document.addEventListener('click', function(e) {
    if (e.target.classList.contains('remove-skill')) {
        e.target.closest('.skill-group').remove();
    }
});
    </script>
@endsection
