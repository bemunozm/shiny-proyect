@extends('layouts.user_type.auth')

@section('content')
<script>
$(document).ready(function() {
    // Cargar regiones al inicializar
    loadStates();

    // Evento change para el selector de Región (State)
    $('#state_select').change(function() {
        var regionId = $(this).val();
        if (regionId) {
            loadProvinces(regionId);
            $('#province_select').empty().append('<option value="">Seleccione una provincia</option>');
            $('#city_select').empty().append('<option value="">Seleccione una comuna</option>');
        } else {
            $('#province_select').empty().append('<option value="">Seleccione una provincia</option>');
            $('#city_select').empty().append('<option value="">Seleccione una comuna</option>');
        }
    });

    // Evento change para el selector de Provincia (Province)
    $('#province_select').change(function() {
        var provinceId = $(this).val();
        if (provinceId) {
            loadCities(provinceId);
        } else {
            $('#city_select').empty().append('<option value="">Seleccione una comuna</option>');
        }
    });

    // Función para cargar las regiones
    function loadStates() {
        $.ajax({
            url: "{{ route('searchState') }}",
            dataType: "json",
            success: function(data) {
                var stateSelect = $('#state_select');
                stateSelect.empty().append('<option value="">Seleccione una región</option>');
                $.each(data, function(i, item) {
                    stateSelect.append(new Option(item.name, item.id));
                });
            }
        });
    }

    // Función para cargar las provincias basadas en la región seleccionada
    function loadProvinces(regionId) {
        $.ajax({
            url: "{{ route('searchProvince') }}",
            dataType: "json",
            data: { region_id: regionId },
            success: function(data) {
                var provinceSelect = $('#province_select');
                provinceSelect.empty().append('<option value="">Seleccione una provincia</option>');
                $.each(data, function(i, item) {
                    provinceSelect.append(new Option(item.name, item.id));
                });
            }
        });
    }

    // Función para cargar las comunas basadas en la provincia seleccionada
    function loadCities(provinceId) {
        $.ajax({
            url: "{{ route('searchCity') }}",
            dataType: "json",
            data: { province_id: provinceId },
            success: function(data) {
                var citySelect = $('#city_select');
                citySelect.empty().append('<option value="">Seleccione una comuna</option>');
                $.each(data, function(i, item) {
                    citySelect.append(new Option(item.name, item.id));
                });
            }
        });
    }
});

</script>
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
                      <select id="job_area" name="job_area" class="form-control">
                          <option value="Abastecimiento">Abastecimiento</option>
                          <option value="Logistica">Logística</option>
                          <option value="Gestion">Gestión</option> 
                          <option value="Marketing">Marketing</option> 
                          <option value="Comercial">Comercial</option> 
                          <option value="Tecnico">Técnico</option> 
                          <option value="Produccion">Producción</option> 
                          <option value="Ventas">Ventas</option> 
                          <option value="Recursos humanos">Recursos Humanos</option> 
                          <option value="Calidad">Calidad</option> 
                          <option value="Administracion">Administración</option>
                          <option value="Ingenieria">Ingenieria</option>
                      </select>
    </div>
    <div class="mb-3">
        <label for="job_sub_area" class="form-label">Subárea</label>
                      <select id="job_sub_area" name="job_sub_area" class="form-control">
                        <option value="Logistica">Logística</option>
                          <option value="Abastecimiento">Abastecimiento</option>
                          <option value="Gestion">Gestión</option> 
                          <option value="Marketing">Marketing</option> 
                          <option value="Comercial">Comercial</option> 
                          <option value="Tecnico">Técnico</option> 
                          <option value="Produccion">Producción</option> 
                          <option value="Ventas">Ventas</option> 
                          <option value="Recursos humanos">Recursos Humanos</option> 
                          <option value="Calidad">Calidad</option> 
                          <option value="Administracion">Administración</option>
                          <option value="Informatica">Informatica</option>
                      </select>
    </div>
    <label>¿Dónde se encuentra el lugar del trabajo?</label>
    <div class="mb-3">
        <label for="state" class="form-label">Región</label>
                      <select class="form-control" id="state_select" name="state_name">
                        <option value="">Seleccione una región</option>
                    </select>
        <!-- Resto de tu formulario... -->
    </div>


    <label for="province" class="form-label mt-2">Provincia</label>
    <select class="form-control" id="province_select" name="province_name">
        <option value="">Provincia</option>
    
    </select>

    <label for="city" class="form-label mt-2">Ciudad</label>
    <select class="form-control mt-2" id="city_select" name="city_name">
        <option value="">Ciudad</option>

    </select>

    <label for="city" class="form-label mt-2">Dirección</label>
    <input type="text" class="form-control mt-2" id="address" name="address" placeholder="Dirección" required>

    <label for="modality" class="form-label mt-2">Modalidad de trabajo</label>
    <select class="form-control mt-2" id="modality" name="modality">
        <option value="Presencial">Presencial</option>
        <option value="Virtual">Virtual</option>
        <option value="Hibrido">Hibrido</option>
    </select>

    <div class="mb-3">
        <label for="job_description" class="form-label">¿En qué consiste el puesto?</label>
        <textarea class="form-control" id="job_description" name="job_description" rows="3" required></textarea>
    </div>
    <div class="mb-3">
        <label for="salaryRange" class="form-label">¿Cuál es el rango salarial bruto que ofreces?</label>
        <input type="number" class="form-control" id="min_salary" name="min_salary" placeholder="Mínimo" required>
        <input type="number" class="form-control mt-2" id="max_salary" name="max_salary" placeholder="Máximo" required>
    </div>
    <div class="row mb-3">
        <div class="col-sm-8">
            <label for="min_experience" class="form-label">¿Cuánto es el mínimo de experiencia deseada?</label>
            <input type="number" class="form-control" id="min_experience" name="min_experience" placeholder="0 (meses)" required>
        </div>
        <div class="col-sm-4">
            <label for="experience_weight" class="form-label">Ponderación</label>
            <input type="number" class="form-control weight-input" id="experience_weight" name="experience_weight" min="1" max="100" placeholder="1-100" required onchange="validateTotalWeight()">
        </div>
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
<script>
    $(document).ready(function() {
        // Cargar regiones al inicializar
        loadStates();
    
        // Evento change para el selector de Región (State)
        $('#state_select').change(function() {
            var regionId = $(this).val();
            if (regionId) {
                loadProvinces(regionId);
                $('#province_select').empty().append('<option value="">Seleccione una provincia</option>');
                $('#city_select').empty().append('<option value="">Seleccione una comuna</option>');
            } else {
                $('#province_select').empty().append('<option value="">Seleccione una provincia</option>');
                $('#city_select').empty().append('<option value="">Seleccione una comuna</option>');
            }
        });
    
        // Evento change para el selector de Provincia (Province)
        $('#province_select').change(function() {
            var provinceId = $(this).val();
            if (provinceId) {
                loadCities(provinceId);
            } else {
                $('#city_select').empty().append('<option value="">Seleccione una comuna</option>');
            }
        });
    
        // Función para cargar las regiones
        function loadStates() {
            $.ajax({
                url: "{{ route('searchState') }}",
                dataType: "json",
                success: function(data) {
                    var stateSelect = $('#state_select');
                    stateSelect.empty().append('<option value="">Seleccione una región</option>');
                    $.each(data, function(i, item) {
                        stateSelect.append(new Option(item.name, item.id));
                    });
                }
            });
        }
    
        // Función para cargar las provincias basadas en la región seleccionada
        function loadProvinces(regionId) {
            $.ajax({
                url: "{{ route('searchProvince') }}",
                dataType: "json",
                data: { region_id: regionId },
                success: function(data) {
                    var provinceSelect = $('#province_select');
                    provinceSelect.empty().append('<option value="">Seleccione una provincia</option>');
                    $.each(data, function(i, item) {
                        provinceSelect.append(new Option(item.name, item.id));
                    });
                }
            });
        }
    
        // Función para cargar las comunas basadas en la provincia seleccionada
        function loadCities(provinceId) {
            $.ajax({
                url: "{{ route('searchCity') }}",
                dataType: "json",
                data: { province_id: provinceId },
                success: function(data) {
                    var citySelect = $('#city_select');
                    citySelect.empty().append('<option value="">Seleccione una comuna</option>');
                    $.each(data, function(i, item) {
                        citySelect.append(new Option(item.name, item.id));
                    });
                }
            });
        }
        
    });
    
    </script>
<script>
    function applyAutocomplete(selector, url, zIndex) {
    $(selector).autocomplete({
        source: function(request, response) {
            $.ajax({
                url: url,
                dataType: "json",
                data: {
                    term: request.term
                },
                success: function(data) {
                    response($.map(data, function(item) {
                        return { label: item.name, value: item.name };
                    }));
                }
            });
        },
        minLength: 2,
        open: function() {
            $(this).autocomplete('widget').css('z-index', zIndex);
            $('.ui-autocomplete').appendTo('body');
        }
    });
}
function applyAutocompleteCareer(selector, url, zIndex) {
    $(selector).autocomplete({
        source: function(request, response) {
            $.ajax({
                url: url,
                dataType: "json",
                data: {
                    term: request.term
                },
                success: function(data) {
                    response($.map(data, function(item) {
                        // Asegúrate de que 'career' es la propiedad correcta del objeto 'item'
                        return { label: item.career, value: item.career };
                    }));
                }
            });
        },
        minLength: 2,
        open: function() {
            $(this).autocomplete('widget').css('z-index', zIndex);
            $('.ui-autocomplete').appendTo('body');
        },
        select: function(event, ui) {
            var selectedCareer = ui.item.value;
            // Asumiendo que 'selector' incluye el índice, por ejemplo, '#career_1'
            var index = $(selector).attr('id').split('_')[1];
            updateInstitutionSelect(selectedCareer, index);
        }
    });
}
function updateInstitutionSelect(selectedCareer, index) {
    var institutionSelect = $(`#institution_${index}`);
    $.ajax({
        url: "{{ route('searchInstitution') }}",
        dataType: "json",
        data: {
            career: selectedCareer
        },
        success: function(data) {
            institutionSelect.empty().append('<option value="">Seleccione una institución</option>');
            $.each(data, function(i, item) {
                institutionSelect.append(new Option(item.institution, item.institution));
            });

            // Limpia el select de tipo de estudio ya que la institución ha cambiado
            var typeOfStudySelect = $(`#type_of_study_${index}`);
            typeOfStudySelect.empty().append('<option value="">Seleccione un tipo de estudio</option>');

            // Añade un evento change al select de institución para actualizar el tipo de estudio
            // cuando se seleccione una institución
            institutionSelect.change(function() {
                // Obtén la institución seleccionada y llama a updateTypeOfStudySelect
                var selectedInstitution = $(this).val();
                updateTypeOfStudySelect(selectedCareer, selectedInstitution, index);
            });

            // Si quieres disparar la actualización inmediatamente después de cargar las instituciones,
            // puedes llamar aquí a updateTypeOfStudySelect, por ejemplo:
            // updateTypeOfStudySelect(selectedCareer, institutionSelect.val(), index);
        }
    });
}

// Función para actualizar el select de tipo de estudio y encadenar la actualización del área de estudio
function updateTypeOfStudySelect(selectedCareer, selectedInstitution, index) {
    var typeOfStudySelect = $(`#type_of_study_${index}`);
    $.ajax({
        url: "{{ route('searchTypeOfStudy') }}",
        dataType: "json",
        data: {
            career: selectedCareer,
            institution: selectedInstitution
        },
        success: function(data) {
            typeOfStudySelect.empty().append('<option value="">Seleccione un tipo de estudio</option>');
            $.each(data, function(i, item) {
                typeOfStudySelect.append(new Option(item.type_of_study, item.type_of_study));
            });

            // Añade un evento change al select de tipo de estudio para actualizar el área de estudio
            typeOfStudySelect.change(function() {
                // Obtén el tipo de estudio seleccionado y llama a updateAreaOfStudySelect
                var selectedTypeOfStudy = $(this).val();
                updateAreaOfStudySelect(selectedCareer, selectedInstitution, selectedTypeOfStudy, index);
            });

            // Si quieres disparar la actualización inmediatamente después de cargar los tipos de estudio,
            // puedes llamar aquí a updateAreaOfStudySelect, por ejemplo:
            //updateAreaOfStudySelect(selectedCareer, selectedInstitution, typeOfStudySelect.val(), index);
        }
    });
}
// Función para actualizar el select de área de estudio y encadenar la actualización de la subárea de estudio
function updateAreaOfStudySelect(selectedCareer, selectedInstitution, selectedTypeOfStudy, index) {
    var areaOfStudySelect = $(`#area_of_study_${index}`);
    $.ajax({
        url: "{{ route('searchArea') }}",
        dataType: "json",
        data: {
            career: selectedCareer,
            institution: selectedInstitution,
            type_of_study: selectedTypeOfStudy
        },
        success: function(data) {
            areaOfStudySelect.empty().append('<option value="">Seleccione un área de estudio</option>');
            $.each(data, function(i, item) {
                areaOfStudySelect.append(new Option(item.area_of_study, item.area_of_study));
            });

            // Añade un evento change al select de área de estudio para actualizar la subárea de estudio
            areaOfStudySelect.change(function() {
                // Obtén el área de estudio seleccionada y llama a updateSubareaOfStudySelect
                var selectedAreaOfStudy = $(this).val();
                updateSubareaOfStudySelect(selectedCareer, selectedInstitution, selectedTypeOfStudy, selectedAreaOfStudy, index);
            });

            // Si quieres disparar la actualización inmediatamente después de cargar las áreas de estudio,
            // puedes llamar aquí a updateSubareaOfStudySelect, por ejemplo:
            // updateSubareaOfStudySelect(selectedCareer, selectedInstitution, selectedTypeOfStudy, areaOfStudySelect.val(), index);
        }
    });
}

function updateSubareaOfStudySelect(selectedCareer, selectedInstitution, selectedTypeOfStudy, selectedAreaOfStudy, index) {
    var subareaOfStudySelect = $(`#subarea_of_study_${index}`);
    
    $.ajax({
        url: "{{ route('searchSubarea') }}",
        dataType: "json",
        data: {
            career: selectedCareer,
            institution: selectedInstitution,
            type_of_study: selectedTypeOfStudy,
            area_of_study: selectedAreaOfStudy
        },
        success: function(data) {
            subareaOfStudySelect.empty().append('<option value="">Seleccione una subárea de estudio</option>');
            $.each(data, function(i, item) {
                subareaOfStudySelect.append(new Option(item.subarea_of_study, item.subarea_of_study));
            });
        },
        error: function(xhr, status, error) {
            console.error("Error al actualizar la subárea de estudio: " + error);
        }
    });
}

    


document.getElementById('addLanguage').addEventListener('click', function() {
    var languageSection = document.getElementById('language-section');
    var index = languageSection.getElementsByClassName('language-group').length;

    var html = `
        <div class="language-group">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="mb-0">Idioma requerido</h5>
                <div class="d-flex align-items-center">
                    <label for="language_weight_${index}" class="form-label me-2">Ponderación</label>
                    <input type="number" class="form-control weight-input" style="width: 100px;" id="language_weight_${index}" name="languages[${index}][weight]" min="1" max="100" placeholder="1-100" required onchange="validateTotalWeight()">
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Nombre del Idioma</label>
                <input type="text" class="form-control language-name" id="language_name_${index}" name="languages[${index}][name]" placeholder="Escribe el nombre del idioma">
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

    languageSection.insertAdjacentHTML('afterbegin', html);
    
    // Aplicar autocompletado al nuevo campo de idioma
    applyAutocomplete(`#language_name_${index}`, "{{ route('searchLanguage') }}", 1050);
    document.getElementById(`language_weight_${index}`).addEventListener('change', validateTotalWeight);
});




document.addEventListener('click', function(e) {
    if (e.target.classList.contains('remove-language') || e.target.classList.contains('remove-education') || e.target.classList.contains('remove-skill')) {
        e.target.closest('div').remove();
        // Ahora sí, llamar a validateTotalWeight para revalidar las ponderaciones
        validateTotalWeight();
    }
});


document.getElementById('addEducation').addEventListener('click', function() {
    var educationSection = $('#education-section');
        var index = $('.education-group').length;

        var html = `
            <div class="education-group">
                <div class="d-flex justify-content-between align-items-center mb-3">
    <h5 class="mb-0">Información de Educación</h5>
    <div class="d-flex align-items-center">
        <label for="education_weight_${index}" class="form-label me-2">Ponderación</label>
        <input type="number" class="form-control weight-input" style="width: 100px;" id="education_weight_${index}" name="education[${index}][weight]" min="1" max="100" placeholder="1-100" required onchange="validateTotalWeight()">
    </div>
</div>
<div class="mb-3">
                    <label class="form-label">Título o Carrera</label>
                    <input type="text" class="form-control career" id="career_${index}" name="education[${index}][career]" placeholder="Título o Carrera">
                </div>
                <div class="mb-3">
                    <label class="form-label">Institución</label>
                    <select class="form-select institution" id="institution_${index}" name="education[${index}][institution]">
                        <option value="">Seleccione una institución</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Tipo de Estudio</label>
                    <select class="form-select type_of_study" id="type_of_study_${index}" name="education[${index}][type_of_study]">
                        <option value="">Seleccione un tipo de estudio</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Área de Estudio</label>
                    <select class="form-select area_of_study" id="area_of_study_${index}" name="education[${index}][area_of_study]">
                        <option value="">Seleccione un área de estudio</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Subárea de Estudio</label>
                    <select class="form-select subarea_of_study" id="subarea_of_study_${index}" name="education[${index}][subarea_of_study]">
                        <option value="">Seleccione un subárea de estudio</option>
                    </select>
                </div>
                <div class="mb-3">
                <label class="form-label">Estado</label>
                <select class="form-select status" id="status_${index}" name="education[${index}][status]">
                    <option value="">Seleccione el estado</option>
                    <option value="En Curso">En curso</option>
                    <option value="Finalizado">Finalizado</option>
                    <option value="Abandonado">Abandonado</option>
                </select>
            </div>
                <button type="button" class="btn btn-danger remove-education">Eliminar Educación</button>
            </div>
        `;

        educationSection.append(html);
        
        // Aplicar autocompletado a los nuevos campos de educación
        applyAutocompleteCareer(`#career_${index}`, "{{ route('searchCareer') }}", 1050);
        document.getElementById(`education_weight_${index}`).addEventListener('change', validateTotalWeight);
    });
// Agregar evento para eliminar el grupo de educación
/*document.addEventListener('click', function(e) {
    if (e.target.classList.contains('remove-education')) {
        e.target.closest('.education-group').remove();
        validateTotalWeight();
    }
});*/


document.getElementById('addSkill').addEventListener('click', function() {
    var skillsSection = document.getElementById('skills-section');
    var index = document.querySelectorAll('.skill-group').length;

    var html = `
        <div class="skill-group">
            <div class="d-flex justify-content-between align-items-center mb-3">
    <h5 class="mb-0">Habilidad</h5>
    <div class="d-flex align-items-center">
        <label for="skill_weight_${index}" class="form-label me-2">Ponderación</label>
        <input type="number" class="form-control weight-input" style="width: 100px;" id="skill_weight_${index}" name="skills[${index}][weight]" min="1" max="100" placeholder="1-100" required onchange="validateTotalWeight()">
    </div>
</div>
<div class="mb-3">
    <label class="form-label">Nombre de la Habilidad</label>
    <input type="text" class="form-control skill-name" id="skill_name_${index}" name="skills[${index}][name]" placeholder="Introduce la habilidad">
</div>

        </div>
    `;

    skillsSection.insertAdjacentHTML('afterbegin', html);
    
    // Aplicar autocompletado al nuevo campo de habilidad
    applyAutocomplete(`#skill_name_${index}`, "{{ route('searchSkill') }}", 1050);
    document.getElementById(`skill_weight_${index}`).addEventListener('change', validateTotalWeight);
});

    
/*document.addEventListener('click', function(e) {
   if (e.target.classList.contains('remove-skill')) {
        e.target.closest('.skill-group').remove();
        validateTotalWeight();
    }
});*/
    let isWeightValid = false; // Esta variable debe ser accesible globalmente

    function validateTotalWeight() {
        let totalWeight = 0;
        document.querySelectorAll('.weight-input').forEach(function(input) {
            totalWeight += parseInt(input.value) || 0;
        });

        isWeightValid = totalWeight === 100;
        document.querySelector('button[type="submit"]').disabled = !isWeightValid;
    }
    $(document).ready(function() {
        $('form').on('submit', function(event) {
        if (!isWeightValid) {
            alert('La suma total de las ponderaciones debe ser exactamente 100.');
            event.preventDefault(); // Evitar que el formulario se envíe
        }
    });

    // Llama a validateTotalWeight para establecer el estado inicial del botón de envío.
    validateTotalWeight();
    });    
    </script>
@endsection
