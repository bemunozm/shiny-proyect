@extends('layouts.user_type.auth')

@section('content')
@if (session('alert-error'))
    <div class="alert alert-danger">
        {{ session('alert-error') }}
    </div>
@endif

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

<div class="container">
    <div class="row">
        
        <div class="col-md-12">
            <h3>Detalles del Puesto</h3>
            <div class="mb-3">
                <strong>¿Qué puesto quieres cubrir?:</strong>
                <p>{{ $replacement->job_name }}</p>
            </div>
            <div class="mb-3">
                <strong>Área del puesto:</strong>
                <p>{{ $replacement->job_area }}</p>
            </div>
            <div class="mb-3">
                <strong>Subárea del puesto:</strong>
                <p>{{ $replacement->job_sub_area }}</p>
            </div>
            <div class="mb-3">
                <strong>¿Dónde se encuentra el lugar del trabajo?:</strong>
                <p>Región: {{ $replacement->state }}</p>
                <p>Provincia: {{ $replacement->province }}</p>
                <p>Comuna: {{ $replacement->city }}</p>
                <p>Dirección: {{ $replacement->address }}</p>
            </div>
            <div class="mb-3">
                <strong>¿En qué consiste el puesto?:</strong>
                <p>{{ $replacement->job_description }}</p>
                
                <p>Estudios deseados:</p>
                <ul>
                    @foreach ($replacement->resume->educations as $education)
                       <li><p>{{$education->career}}</p> </li>
                    @endforeach
                    </ul>
                <p>Idiomas deseados:</p>
                <ul>
                @foreach ($replacement->resume->languages as $language)
                   <li><p>{{$language->name}} {{$language->pivot->written_level}}</p> </li>
                @endforeach
                </ul>
                <p>Habilidades deseadas:</p>
                <ul>
                @foreach ($replacement->resume->skills as $skill)
                   <li><p>{{$skill->name}}</p></li> 
                @endforeach
                </ul>
            </div>
            <div class="mb-3">
                <strong>¿Cuál es el rango salarial bruto que ofreces?:</strong>
                <p>Desde: ${{ number_format($replacement->min_salary, 2) }}</p>
                <p>Hasta: ${{ number_format($replacement->max_salary, 2) }}</p>
            </div>
            <div class="mb-3">
                <strong>¿Cuánto es el mínimo de experiencia deseada?:</strong>
                <p>{{ $replacement->min_experience }} meses</p>
            </div>
            <div class="modal-footer">
                <a href="{{ route('replacement.asignar', $replacement->id) }}" class="btn bg-gradient-primary">POSTULA AHORA</a>
            </div>
        </div>
    </div>
</div>

@endsection
