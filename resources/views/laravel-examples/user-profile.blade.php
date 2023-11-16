@extends('layouts.user_type.auth')

@section('content')

<script>
$(document).ready(function() {
    // Inicializar los distintos conjuntos de selectores
    initializeSelectorSet(1);
    initializeSelectorSet(2);
    // Puedes agregar más si es necesario

    // Función para inicializar cada conjunto de selectores
    function initializeSelectorSet(setNumber) {
        loadStates(`#state_select_${setNumber}`);

        $(`#state_select_${setNumber}`).change(function() {
            var stateId = $(this).val();
            if (stateId) {
                loadProvinces(stateId, `#province_select_${setNumber}`);
            } else {
                $(`#province_select_${setNumber}`).empty().append('<option value="">Seleccione una provincia</option>');
                $(`#city_select_${setNumber}`).empty().append('<option value="">Seleccione una ciudad</option>');
            }
        });

        $(`#province_select_${setNumber}`).change(function() {
            var provinceId = $(this).val();
            if (provinceId) {
                loadCities(provinceId, `#city_select_${setNumber}`);
            } else {
                $(`#city_select_${setNumber}`).empty().append('<option value="">Seleccione una ciudad</option>');
            }
        });
    }

    // Función para cargar las regiones
    function loadStates(selector) {
        $.ajax({
            url: "{{ route('searchState') }}",
            dataType: "json",
            success: function(data) {
                var stateSelect = $(selector);
                stateSelect.empty().append('<option value="">Seleccione una región</option>');
                $.each(data, function(i, item) {
                    stateSelect.append(new Option(item.name, item.id));
                });
            }
        });
    }

    // Función para cargar las provincias
    function loadProvinces(stateId, selector) {
        $.ajax({
            url: "/search-province",
            type: "GET",
            dataType: "json",
            data: { region_id: stateId },
            success: function(data) {
                var provinceSelect = $(selector);
                provinceSelect.empty().append('<option value="">Seleccione una provincia</option>');
                $.each(data, function(i, item) {
                    provinceSelect.append(new Option(item.name, item.id));
                });
            }
        });
    }

    // Función para cargar las ciudades
    function loadCities(provinceId, selector) {
        $.ajax({
            url: "{{ route('searchCity') }}",
            dataType: "json",
            data: { province_id: provinceId },
            success: function(data) {
                var citySelect = $(selector);
                citySelect.empty().append('<option value="">Seleccione una ciudad</option>');
                $.each(data, function(i, item) {
                    citySelect.append(new Option(item.name, item.id));
                });
            }
        });
    }
});

</script>

<div>
    <div class="container-fluid">
        <div class="page-header min-height-300 border-radius-xl mt-4" style="background-image: url('../assets/img/curved-images/curved0.jpg'); background-position-y: 50%;">
            <span class="mask bg-gradient-primary opacity-6"></span>
        </div>
        <div class="card card-body blur shadow-blur mx-4 mt-n6">
            <div class="row gx-4">
                <div class="col-auto">
                    <div class="avatar avatar-xl position-relative">
                        <img src="../assets/img/bruce-mars.jpg" alt="..." class="w-100 border-radius-lg shadow-sm">
                        <a href="javascript:;" class="btn btn-sm btn-icon-only bg-gradient-light position-absolute bottom-0 end-0 mb-n2 me-n2">
                            <i class="fa fa-pen top-0" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Image"></i>
                        </a>
                    </div>
                </div>
                <div class="col-auto my-auto">
                    <div class="h-100">
                        <h5 class="mb-1">
                            {{$id->name}}
                        </h5>
                        <p class="mb-0 font-weight-bold text-sm">
                            {{$id->last_name }}
                        </p>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3">
                    <div class="nav-wrapper position-relative end-0">
                        <ul class="nav nav-pills nav-fill p-1 bg-transparent" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link mb-0 px-0 py-1 active" data-bs-toggle="tab" href="#educacion-panel" role="tab">
                                    <svg class="text-dark" width="16px" height="16px" viewBox="0 0 42 42" version="1.1"
                                        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                        <g id="Basic-Elements" stroke="none" stroke-width="1" fill="none"
                                            fill-rule="evenodd">
                                            <g id="Rounded-Icons" transform="translate(-2319.000000, -291.000000)"
                                                fill="#FFFFFF" fill-rule="nonzero">
                                                <g id="Icons-with-opacity"
                                                    transform="translate(1716.000000, 291.000000)">
                                                    <g id="box-3d-50" transform="translate(603.000000, 0.000000)">
                                                        <path class="color-background" d="M22.7597136,19.3090182 L38.8987031,11.2395234 C39.3926816,10.9925342 39.592906,10.3918611 39.3459167,9.89788265 C39.249157,9.70436312 39.0922432,9.5474453 38.8987261,9.45068056 L20.2741875,0.1378125 L20.2741875,0.1378125 C19.905375,-0.04725 19.469625,-0.04725 19.0995,0.1378125 L3.1011696,8.13815822 C2.60720568,8.38517662 2.40701679,8.98586148 2.6540352,9.4798254 C2.75080129,9.67332903 2.90771305,9.83023153 3.10122239,9.9269862 L21.8652864,19.3090182 C22.1468139,19.4497819 22.4781861,19.4497819 22.7597136,19.3090182 Z" id="Path"></path>
                                                        <path class="color-background" d="M23.625,22.429159 L23.625,39.8805372 C23.625,40.4328219 24.0727153,40.8805372 24.625,40.8805372 C24.7802551,40.8805372 24.9333778,40.8443874 25.0722402,40.7749511 L41.2741875,32.673375 L41.2741875,32.673375 C41.719125,32.4515625 42,31.9974375 42,31.5 L42,14.241659 C42,13.6893742 41.5522847,13.241659 41,13.241659 C40.8447549,13.241659 40.6916418,13.2778041 40.5527864,13.3472318 L24.1777864,21.5347318 C23.8390024,21.7041238 23.625,22.0503869 23.625,22.429159 Z" id="Path" opacity="0.7"></path>
                                                        <path class="color-background" d="M20.4472136,21.5347318 L1.4472136,12.0347318 C0.953235098,11.7877425 0.352562058,11.9879669 0.105572809,12.4819454 C0.0361450918,12.6208008 6.47121774e-16,12.7739139 0,12.929159 L0,30.1875 L0,30.1875 C0,30.6849375 0.280875,31.1390625 0.7258125,31.3621875 L19.5528096,40.7750766 C20.0467945,41.0220531 20.6474623,40.8218132 20.8944388,40.3278283 C20.963859,40.1889789 21,40.0358742 21,39.8806379 L21,22.429159 C21,22.0503869 20.7859976,21.7041238 20.4472136,21.5347318 Z" id="Path" opacity="0.7"></path>
                                                    </g>
                                                </g>
                                            </g>
                                        </g>
                                    </svg>

                                  
                                    <span class="ms-1">{{ __('Educacion') }}</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link mb-0 px-0 py-0" data-bs-toggle="tab" href="#Habilidades-panel" role="tab">
                                    <svg class="text-dark" width="16px" height="16px" viewBox="0 0 40 44" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                        <title>document</title>
                                        <g id="Basic-Elements" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <g id="Rounded-Icons" transform="translate(-1870.000000, -591.000000)" fill="#FFFFFF" fill-rule="nonzero">
                                                <g id="Icons-with-opacity" transform="translate(1716.000000, 291.000000)">
                                                    <g id="document" transform="translate(154.000000, 300.000000)">
                                                        <path class="color-background" d="M40,40 L36.3636364,40 L36.3636364,3.63636364 L5.45454545,3.63636364 L5.45454545,0 L38.1818182,0 C39.1854545,0 40,0.814545455 40,1.81818182 L40,40 Z" id="Path" opacity="0.603585379"></path>
                                                        <path class="color-background" d="M30.9090909,7.27272727 L1.81818182,7.27272727 C0.814545455,7.27272727 0,8.08727273 0,9.09090909 L0,41.8181818 C0,42.8218182 0.814545455,43.6363636 1.81818182,43.6363636 L30.9090909,43.6363636 C31.9127273,43.6363636 32.7272727,42.8218182 32.7272727,41.8181818 L32.7272727,9.09090909 C32.7272727,8.08727273 31.9127273,7.27272727 30.9090909,7.27272727 Z M18.1818182,34.5454545 L7.27272727,34.5454545 L7.27272727,30.9090909 L18.1818182,30.9090909 L18.1818182,34.5454545 Z M25.4545455,27.2727273 L7.27272727,27.2727273 L7.27272727,23.6363636 L25.4545455,23.6363636 L25.4545455,27.2727273 Z M25.4545455,20 L7.27272727,20 L7.27272727,16.3636364 L25.4545455,16.3636364 L25.4545455,20 Z" id="Shape"></path>
                                                    </g>
                                                </g>
                                            </g>
                                        </g>
                                    </svg>

                                 
                                    <span class="ms-1">{{ __('Habilidad') }}</span>

                            <li class="nav-item">
                                <a class="nav-link mb-0 px-0 py-0" data-bs-toggle="tab" href="#lenguaje-panel" role="tab">
                                    <svg class="text-dark" width="16px" height="16px" viewBox="0 0 40 44" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                        <title>document</title>
                                        <g id="Basic-Elements" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <g id="Rounded-Icons" transform="translate(-1870.000000, -591.000000)" fill="#FFFFFF" fill-rule="nonzero">
                                                <g id="Icons-with-opacity" transform="translate(1716.000000, 291.000000)">
                                                    <g id="document" transform="translate(154.000000, 300.000000)">
                                                        <path class="color-background" d="M40,40 L36.3636364,40 L36.3636364,3.63636364 L5.45454545,3.63636364 L5.45454545,0 L38.1818182,0 C39.1854545,0 40,0.814545455 40,1.81818182 L40,40 Z" id="Path" opacity="0.603585379"></path>
                                                        <path class="color-background" d="M30.9090909,7.27272727 L1.81818182,7.27272727 C0.814545455,7.27272727 0,8.08727273 0,9.09090909 L0,41.8181818 C0,42.8218182 0.814545455,43.6363636 1.81818182,43.6363636 L30.9090909,43.6363636 C31.9127273,43.6363636 32.7272727,42.8218182 32.7272727,41.8181818 L32.7272727,9.09090909 C32.7272727,8.08727273 31.9127273,7.27272727 30.9090909,7.27272727 Z M18.1818182,34.5454545 L7.27272727,34.5454545 L7.27272727,30.9090909 L18.1818182,30.9090909 L18.1818182,34.5454545 Z M25.4545455,27.2727273 L7.27272727,27.2727273 L7.27272727,23.6363636 L25.4545455,23.6363636 L25.4545455,27.2727273 Z M25.4545455,20 L7.27272727,20 L7.27272727,16.3636364 L25.4545455,16.3636364 L25.4545455,20 Z" id="Shape"></path>
                                                    </g>
                                                </g>
                                            </g>
                                        </g>
                                    </svg>

                                   
                                    <span class="ms-1">{{ __('Idioma') }}</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link mb-0 px-0 py-0" data-bs-toggle="tab" href="#experiencia-panel" role="tab">
                                    <svg class="text-dark" width="16px" height="16px" viewBox="0 0 40 44" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                        <title>document</title>
                                        <g id="Basic-Elements" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <g id="Rounded-Icons" transform="translate(-1870.000000, -591.000000)" fill="#FFFFFF" fill-rule="nonzero">
                                                <g id="Icons-with-opacity" transform="translate(1716.000000, 291.000000)">
                                                    <g id="document" transform="translate(154.000000, 300.000000)">
                                                        <path class="color-background" d="M40,40 L36.3636364,40 L36.3636364,3.63636364 L5.45454545,3.63636364 L5.45454545,0 L38.1818182,0 C39.1854545,0 40,0.814545455 40,1.81818182 L40,40 Z" id="Path" opacity="0.603585379"></path>
                                                        <path class="color-background" d="M30.9090909,7.27272727 L1.81818182,7.27272727 C0.814545455,7.27272727 0,8.08727273 0,9.09090909 L0,41.8181818 C0,42.8218182 0.814545455,43.6363636 1.81818182,43.6363636 L30.9090909,43.6363636 C31.9127273,43.6363636 32.7272727,42.8218182 32.7272727,41.8181818 L32.7272727,9.09090909 C32.7272727,8.08727273 31.9127273,7.27272727 30.9090909,7.27272727 Z M18.1818182,34.5454545 L7.27272727,34.5454545 L7.27272727,30.9090909 L18.1818182,30.9090909 L18.1818182,34.5454545 Z M25.4545455,27.2727273 L7.27272727,27.2727273 L7.27272727,23.6363636 L25.4545455,23.6363636 L25.4545455,27.2727273 Z M25.4545455,20 L7.27272727,20 L7.27272727,16.3636364 L25.4545455,16.3636364 L25.4545455,20 Z" id="Shape"></path>
                                                    </g>
                                                </g>
                                            </g>
                                        </g>
                                    </svg>

                                    
                                    <span class="ms-1">{{ __('Experiencia') }}</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link mb-0 px-0 py-0 " data-bs-toggle="tab" href="#perfil-panel" role="tab">
                                    <svg class="text-dark" width="16px" height="16px" viewBox="0 0 40 40" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                        <title>settings</title>
                                        <g id="Basic-Elements" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <g id="Rounded-Icons" transform="translate(-2020.000000, -442.000000)" fill="#FFFFFF" fill-rule="nonzero">
                                                <g id="Icons-with-opacity" transform="translate(1716.000000, 291.000000)">
                                                    <g id="settings" transform="translate(304.000000, 151.000000)">
                                                        <polygon class="color-background" id="Path" opacity="0.596981957" points="18.0883333 15.7316667 11.1783333 8.82166667 13.3333333 6.66666667 6.66666667 0 0 6.66666667 6.66666667 13.3333333 8.82166667 11.1783333 15.315 17.6716667">
                                                        </polygon>
                                                        <path class="color-background" d="M31.5666667,23.2333333 C31.0516667,23.2933333 30.53,23.3333333 30,23.3333333 C29.4916667,23.3333333 28.9866667,23.3033333 28.48,23.245 L22.4116667,30.7433333 L29.9416667,38.2733333 C32.2433333,40.575 35.9733333,40.575 38.275,38.2733333 L38.275,38.2733333 C40.5766667,35.9716667 40.5766667,32.2416667 38.275,29.94 L31.5666667,23.2333333 Z" id="Path" opacity="0.596981957"></path>
                                                        <path class="color-background" d="M33.785,11.285 L28.715,6.215 L34.0616667,0.868333333 C32.82,0.315 31.4483333,0 30,0 C24.4766667,0 20,4.47666667 20,10 C20,10.99 20.1483333,11.9433333 20.4166667,12.8466667 L2.435,27.3966667 C0.95,28.7083333 0.0633333333,30.595 0.00333333333,32.5733333 C-0.0583333333,34.5533333 0.71,36.4916667 2.11,37.89 C3.47,39.2516667 5.27833333,40 7.20166667,40 C9.26666667,40 11.2366667,39.1133333 12.6033333,37.565 L27.1533333,19.5833333 C28.0566667,19.8516667 29.01,20 30,20 C35.5233333,20 40,15.5233333 40,10 C40,8.55166667 39.685,7.18 39.1316667,5.93666667 L33.785,11.285 Z" id="Path"></path>
                                                    </g>
                                                </g>
                                            </g>
                                        </g>
                                    </svg>

                                    <span class="ms-1">{{ __('Perfil') }}</span>
                                </a>
                            </li>
                            
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="container-fluid py-4">
                    <div class="tab-content">
                        <div class="tab-pane active show" id="educacion-panel">
                            <div class="card">
                                <div class="card-header pb-0 px-3">
                                    <h6 class="mb-0">{{ __('Educación') }}</h6>
                                </div>
                                <div class="card-body pt-4 p-3">
                                    <!-- Formulario para Educación -->
                                    @if ($current_id == $id->id)
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#sumarEducacionModal">
                                        + Sumar Educación
                                       </button>
                                       
                                    @endif
                                    
                                    @if ($resume->educations->isNotEmpty())
                                    <table class="table align-items-center mb-0">
                                        <thead>
                                            <tr>
                                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Titulo</th>
                                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Tipo de Estudio</th>
                                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Institucion</th>
                                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Estado</th>
                                                @if ($current_id == $id->id)<th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Acciones</th>@endif
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($resume->educations as $education)
                                                <tr>
                                                    <td>
                                                        <div class="d-flex px-2">
                                                          <div class="my-auto">
                                                            <h6 class="mb-0 text-xs">{{$education->career}}</h6>
                                                          </div>
                                                        </div>
                                                    </td>
                                                    
                                                    <td>
                                                        <p class="text-xs font-weight-normal mb-0">{{$education->type_of_study}}</p>
                                                    </td>
                                                    <td>
                                                        <span class="badge badge-dot me-4">
                                                        <i class="bg-info"></i>
                                                        <span class="text-dark text-xs">{{$education->institution}}</span>
                                                        </span>
                                                    </td>
                                                    <td class="align-middle text-center">
                                                        <div class="d-flex align-items-center">
                                                        @if ($education->pivot->status == 'Finalizado')
                                                            <span class="badge badge-sm bg-gradient-success">Finalizado</span>
                                                        @elseif($education->pivot->status == 'En Curso')
                                                            <span class="badge bg-gradient-warning">En Curso</span>
                                                        @else
                                                            <span class="badge bg-gradient-danger">Abandonado</span>
                                                        @endif
                                                        </div>
                                                    </td>
                                                    @if ($current_id == $id->id)
                                                    <td class="align-middle">
                                                        {{--<button class="btn btn-link text-secondary mb-0">
                                                        <span class="material-icons">
                                                        Ver Mas
                                                        </span>
                                                        </button>--}}
                                                        
                                                        
                                                        <form method="POST" action="{{route('user-education.destroy', $education->pivot->id)}}">
                                                            @csrf
                                                            @method('DELETE')
                                                            <input class="btn btn-link text-secondary mb-0" type="submit" value="Eliminar"/>
                                                        </form>
                                                        
                                                    </td>
                                                    @endif
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    @endif
                                </div>
                                
                            </div>
                        </div>
                         
                        <div class="tab-pane" id="habilidades-panel">
                            <div class="card">
                                <div class="card-header pb-0 px-3">
                                    <h6 class="mb-0">{{ __('Habilidades') }}</h6>
                                </div>
                                <div class="card-body pt-4 p-3">
                                    <!-- Botón para abrir el modal de "Agregar Habilidad" -->
                                    @if ($current_id == $id->id)
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#sumarHabilidadesModal">
                                            + Agregar Habilidad
                                        </button>
                                    @endif
                        
                                    <!-- Tabla de Habilidades -->
                                    <div >
                                        @if ($resume->skills->isNotEmpty())
                                        <div class="d-flex flex-row">
                                            @foreach ($resume->skills as $skill)
                                                 <!-- Agrega márgenes entre los elementos -->
                                                    @if ($current_id == $id->id)
                                                        <form method="POST" action="{{ route('user-skills.destroy', $skill->pivot->id) }}">
                                                            @csrf
                                                            @method('DELETE')
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <button type="submit" class="btn btn-outline-primary">
                                                                            <span>{{$skill->name}}</span>
                                                                            <span class="badge badge-danger position-absolute top-0 end-0" style="cursor: pointer; color: black;">X</span>
                                                                          </button>
                                                                    </div>
                                                                </div>
                                                            </div>    
                                                        </form>
                                                    @else
                                                        
                                                    <ul>
                                                        
                                                        <li>{{$skill->name}}</li>
                                                        
                                                    </ul>
                                                    @endif
                                                
                                            @endforeach
                                        </div>
                                        @endif
                                    </div>

                                </div>
                            </div>
                        </div>
                                                
                        
                        <div class="tab-pane fade" id="lenguaje-panel">
                            <div class="card">
                                <div class="card-header pb-0 px-3">
                                    <h6 class="mb-0">{{ __('Lenguaje') }}</h6>
                                </div>
                                <div class="card-body pt-4 p-3">
                                <!-- Botón para abrir el modal de "Sumar experiencia" -->
                                @if ($current_id == $id->id)
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#sumarLenguajeModal">
                                    + Sumar lenguaje
                                </button>
                                @endif
                                @if ($resume->languages->isNotEmpty())
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Idioma</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Nivel Escrito</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Nivel Oral</th>
                                            @if ($current_id == $id->id)<th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Acciones</th>@endif
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($resume->languages as $language)
                                            <tr>
                                                <td>
                                                    <span class="badge badge-dot me-4">
                                                        <i class="bg-info"></i>
                                                        <span class="text-dark text-xs">{{$language->name}}</span>
                                                        </span>
                                                </td>
                                                
                                                <td>
                                                    <span class="badge badge-dot me-4">
                                                        <i class="bg-info"></i>
                                                        <span class="text-dark text-xs">{{$language->pivot->written_level}}</span>
                                                        </span>
                                                </td>
                                                <td>
                                                    <span class="badge badge-dot me-4">
                                                    <i class="bg-info"></i>
                                                    <span class="text-dark text-xs">{{$language->pivot->oral_level}}</span>
                                                    </span>
                                                </td>

                                                @if ($current_id == $id->id)
                                                <td class="align-middle">
                                                    <form method="POST" action="{{route('user-language.destroy', $language->pivot->id)}}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <input class="btn btn-link text-secondary mb-0" type="submit" value="Eliminar"/>
                                                    </form>
                                                    
                                                </td>
                                                @endif
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                @endif
                                </div>
                            </div>    
                        </div>
                        
                        <div class="tab-pane fade" id="experiencia-panel">
                            <div class="card">
                                <div class="card-header pb-0 px-3">
                                    <h6 class="mb-0">{{ __('Experiencia') }}</h6>
                                </div>
                                <div class="card-body pt-4 p-3">
                                <!-- Botón para abrir el modal de "Sumar experiencia" -->
                                @if ($current_id == $id->id)
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#sumarExperienciaModal">
                                    + Sumar experiencia
                                </button>
                                @endif
                                @if ($resume->experiences->isNotEmpty())
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Puesto de trabajo</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Compañia</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Area</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Experiencia (meses)</th>
                                            @if ($current_id == $id->id)<th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Acciones</th>@endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($resume->experiences as $experience)
                                            <tr>
                                                <td>
                                                    <div class="d-flex px-2">
                                                      <div class="my-auto">
                                                        <h6 class="mb-0 text-xs">{{$experience->job}}</h6>
                                                      </div>
                                                    </div>
                                                </td>
                                                
                                                <td>
                                                    <p class="text-xs font-weight-normal mb-0">{{$experience->company_name}}</p>
                                                </td>
                                                <td>
                                                    <span class="badge badge-dot me-4">
                                                    <i class="bg-info"></i>
                                                    <span class="text-dark text-xs">{{$experience->job_area}}</span>
                                                    </span>
                                                </td>
                                                <td class="align-middle text-center">
                                                    @php
                                                        $startDateStr = $experience->start_date;
                                                        $finishDateStr = $experience->finish_date;

                                                        $startDate = \Carbon\Carbon::parse($startDateStr);
                                                        $finishDate = \Carbon\Carbon::parse($finishDateStr);

                                                        if ($startDate && $finishDate) {
                                                            $monthsDifference = $startDate->diffInMonths($finishDate);
                                                            echo $monthsDifference . ' meses'; // Muestra la diferencia en meses
                                                        }
                                                    @endphp
                                                </td>
                                                @if ($current_id == $id->id)
                                                <td class="align-middle">
                                                    <form method="POST" action="{{route('user-experience.destroy', $experience->id)}}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <input class="btn btn-link text-secondary mb-0" type="submit" value="Eliminar"/>
                                                    </form>
                                                </td>
                                                @endif
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                @endif
                                <!-- ... (resto de contenido en Experiencia) ... -->
                            </div>
                            </div>
                        </div>
                        
                        
                
                        <div class="tab-pane fade" id="perfil-panel">
                            <div class="card">
                            <div class="card-header pb-0 px-3">
                            <h6 class="mb-0">{{ __('Perfil') }}</h6>
                            </div>
                            <div class="card-body pt-4 p-3">
                            <!-- Formulario para Perfil -->
                            @if ($current_id == $id->id)
                            <form action="{{route('user-profile.update', $id)}}" method="POST">
                                @method('PUT')
                                @csrf
                                
                                {{--NUMERO DE DOCUMENTO--}}
                                
                                <br/><h5>Informacion Personal</h5><br/>
                                <div class="row"> 
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="document_type">{{ __('Tipo de documento') }}</label>
                                            <select id="document_type" name="document_type" class="form-control">
                                                <option value="RUT">R.U.T</option>
                                                <option value="Pasaporte">Pasaporte</option>
                                                <option value="Licencia">Licencia de conducir</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row align-items-center">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="document">{{ __('Número de documento') }}</label>
                                            <input type="number" id="document" name="document" class="form-control" value="{{$id->document}}" placeholder="13215330">
                                        </div>
                                    </div>
                                    <div class="col-md-1" style="display: flex; align-items: center; justify-content: center;">
                                        -
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group" style="margin-bottom: 0;">
                                            <input type="text" id="verifier_code" name="verifier_code" class="form-control" value="{{$id->verifier_code}}" placeholder="K" style="width: 40px; text-align: center;">
                                        </div>
                                    </div>
                                </div>
                                
                                {{--NOMBRES Y APELLIDOS--}} 
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name">{{ __('Nombre') }}</label>
                                            <input type="text" id="name" name="name" class="form-control" value="{{$id->name}}" placeholder="Nombres">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="last_name">{{ __('Apellido') }}</label>
                                            <input type="text" id="last_name" name="last_name" class="form-control" value="{{$id->last_name}}" placeholder="Apellidos">
                                        </div>
                                    </div>
                                </div>
                        
                                <div class="form-group">
                                    <label>{{ __('Fecha de nacimiento') }}</label>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <input type="date" name="birthdate" class="form-control" value="{{$id->birthdate}}">
                                        </div>
                                    </div>
                                </div> 
                                <br/><h5>Informacion de Contacto</h5><br/>
                                {{--INFORMACION DE CONTACTO--}}
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="phone">{{ __('Telefono') }}</label>
                                            <input type="number" id="phone" name="phone" class="form-control" value="{{$id->phone}}" placeholder="965651670">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="email">{{ __('Email') }}</label>
                                            <input type="text" id="email" name="email" class="form-control" value="{{$id->email}}" placeholder="example@example.com">
                                        </div>
                                    </div>
                                </div>
                        
                  
                                
                                {{--INFORMACION DE RESIDENCIA--}}
                                <br/><h5>Informacion de Residencia</h5><br/>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="state_select">{{ __('Region') }}</label>
                                            <select id="state_select_2" name="state_name" class="form-control">
                                                <option value="">Seleccione una región</option>
                                                <!-- Las opciones se llenarán dinámicamente -->
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="province_select">{{ __('Provincia') }}</label>
                                            <select id="province_select_2" name="province_name" class="form-control">
                                                <option value="">Seleccione una provincia</option>
                                                <!-- Las opciones se llenarán dinámicamente -->
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="city_select">{{ __('Ciudad') }}</label>
                                            <select id="city_select_2" name="city_name" class="form-control">
                                                <option value="">Seleccione una ciudad</option>
                                                <!-- Las opciones se llenarán dinámicamente -->
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                    
                                {{--OTRA INFORMACION--}}
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="gender">{{ __('Género') }}</label>
                                            <select id="gender" name="gender" class="form-control">
                                                <option value="Masculino" {{ $id->gender == 'Masculino' ? 'selected' : '' }}>Masculino</option>
                                                <option value="Femenino" {{ $id->gender == 'Femenino' ? 'selected' : '' }}>Femenino</option>
                                                <option value="Otro" {{ $id->gender == 'Otro' ? 'selected' : '' }}>Otro</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="marital_status">{{ __('Estado Civil') }}</label>
                                            <select id="marital_status" name="marital_status" class="form-control">
                                                <option value="Soltero" {{ $id->marital_status == 'Soltero' ? 'selected' : '' }}>Soltero</option>
                                                <option value="Casado" {{ $id->marital_status == 'Casado' ? 'selected' : '' }}>Casado</option>
                                                <option value="Divorciado" {{ $id->marital_status == 'Divorciado' ? 'selected' : '' }}>Divorciado</option>
                                                <option value="Pareja de Hecho" {{ $id->marital_status == 'Pareja de Hecho' ? 'selected' : '' }}>Pareja de Hecho</option>
                                                <option value="Viudo" {{ $id->marital_status == 'Viudo' ? 'selected' : '' }}>Viudo</option>
                                                <option value="Union Libre" {{ $id->marital_status == 'Union Libre' ? 'selected' : '' }}>Union Libre</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="d-flex justify-content-end">
                                    <input type="submit" class="btn bg-gradient-dark btn-md mt-4 mb-4" value="Guardar Cambios"></input>
                                </div>
                            </form>
                            @else
                            <h5>Información de Contacto</h5>
                            <div class="row">
                                <div class="col-md-6">
                                    <p><strong>Teléfono:</strong> {{ $id->phone }}</p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>Email:</strong> {{ $id->email }}</p>
                                </div>
                            </div>

                            <h5>Información de Residencia</h5>
                            <div class="row">
                                <div class="col-md-6">
                                    <p><strong>Región:</strong> {{ $id->state }}</p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>Provincia:</strong> {{ $id->province }}</p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>Ciudad:</strong> {{ $id->city }}</p>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

                <script>
                    $(document).ready(function() {
    // Autocompletado para 'career'
    $('#career').autocomplete({
        source: function(request, response) {
            $.ajax({
                url: "{{ route('searchCareer') }}",
                dataType: "json",
                data: {
                    term: request.term
                },
                success: function(data) {
                    response($.map(data, function(item) {
                        return { label: item.career, value: item.career };
                    }));
                }
            });
        },
        minLength: 2,
        open: function() {
            $(this).autocomplete('widget').css('z-index', 1050);
            $('.ui-autocomplete').appendTo('body');
        },
        select: function(event, ui) {
            var selectedCareer = ui.item.value;
            updateInstitutionSelect(selectedCareer); // Actualiza el select de instituciones
        }
    });

    // Función para actualizar el select de 'institution' basado en la carrera seleccionada
    function updateInstitutionSelect(selectedCareer) {
        $.ajax({
            url: "{{ route('searchInstitution') }}", // Asegúrate de que esta ruta sea correcta
            dataType: "json",
            data: {
                career: selectedCareer
            },
            success: function(data) {
                var institutionSelect = $('#institution');
                institutionSelect.empty(); // Limpia las opciones existentes
                institutionSelect.append($('<option>', {
                    value: '',
                    text: 'Seleccione una institución'
                }));

                // Agrega nuevas opciones al select de instituciones
                $.each(data, function(index, item) {
                    institutionSelect.append($('<option>', {
                        value: item.institution,
                        text: item.institution
                    }));
                });
            }
        });
    }
});

$(document).ready(function() {
    // ... Código existente para autocompletado de carrera ...

    // Función para actualizar el select de 'type_of_study'
    function updateTypeOfStudySelect() {
        var selectedCareer = $('#career').val();
        var selectedInstitution = $('#institution').val();

        $.ajax({
            url: "{{ route('searchTypeOfStudy') }}",
            dataType: "json",
            data: {
                career: selectedCareer,
                institution: selectedInstitution
            },
            success: function(data) {
                var typeOfStudySelect = $('#type_of_study');
                typeOfStudySelect.empty(); // Limpia las opciones existentes
                typeOfStudySelect.append($('<option>', {
                    value: '',
                    text: 'Seleccione un tipo de estudio'
                }));

                // Agrega nuevas opciones al select de 'type_of_study'
                $.each(data, function(index, item) {
                    typeOfStudySelect.append($('<option>', {
                        value: item.type_of_study,
                        text: item.type_of_study
                    }));
                });
            }
        });
    }

    // Llama a 'updateTypeOfStudySelect' cuando cambien los campos de carrera o institución
    $('#career, #institution').change(updateTypeOfStudySelect);
});




$(document).ready(function() {
    // ... Código existente ...

    // Función para actualizar el select de 'area_of_study'
    function updateAreaOfStudySelect() {
        var selectedCareer = $('#career').val();
        var selectedInstitution = $('#institution').val();
        var selectedTypeOfStudy = $('#type_of_study').val();

        $.ajax({
            url: "{{ route('searchArea') }}",
            dataType: "json",
            data: {
                career: selectedCareer,
                institution: selectedInstitution,
                type_of_study: selectedTypeOfStudy
            },
            success: function(data) {
                var areaOfStudySelect = $('#area_of_study');
                areaOfStudySelect.empty(); // Limpia las opciones existentes
                areaOfStudySelect.append($('<option>', {
                    value: '',
                    text: 'Seleccione un área de estudio'
                }));

                // Agrega nuevas opciones al select de 'area_of_study'
                $.each(data, function(index, item) {
                    areaOfStudySelect.append($('<option>', {
                        value: item.area_of_study,
                        text: item.area_of_study
                    }));
                });
            }
        });
    }

    // Actualizar 'area_of_study' cuando cambien los campos relevantes
    $('#career, #institution, #type_of_study').change(updateAreaOfStudySelect);
});



$(document).ready(function() {
    // ... Código existente ...

    // Función para actualizar el select de 'subarea_of_study'
    function updateSubareaOfStudySelect() {
        var selectedCareer = $('#career').val();
        var selectedInstitution = $('#institution').val();
        var selectedTypeOfStudy = $('#type_of_study').val();
        var selectedAreaOfStudy = $('#area_of_study').val();

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
                var subareaOfStudySelect = $('#subarea_of_study');
                subareaOfStudySelect.empty(); // Limpia las opciones existentes
                subareaOfStudySelect.append($('<option>', {
                    value: '',
                    text: 'Seleccione un subárea de estudio'
                }));

                // Agrega nuevas opciones al select de 'subarea_of_study'
                $.each(data, function(index, item) {
                    subareaOfStudySelect.append($('<option>', {
                        value: item.subarea_of_study,
                        text: item.subarea_of_study
                    }));
                });
            }
        });
    }

    // Actualizar 'subarea_of_study' cuando cambien los campos relevantes
    $('#career, #institution, #type_of_study, #area_of_study').change(updateSubareaOfStudySelect);
});


                    
                    </script>
                    
                    {{--NO BORRAR--}}
                    <script>

                        $(document).ready(function() {
                            $('#skill_name').autocomplete({
                                source: function(request, response) {
                                    $.ajax({
                                        url: "{{ route('searchSkill') }}",
                                        dataType: "json",
                                        data: {
                                            term: request.term,
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
                                    $(this).autocomplete('widget').css('z-index', 1050);
                                    $('.ui-autocomplete').appendTo('body');
                                }
                            });
                        });

                        $(document).ready(function() {
                            $('#language_name').autocomplete({
                                source: function(request, response) {
                                    $.ajax({
                                        url: "{{ route('searchLanguage') }}",
                                        dataType: "json",
                                        data: {
                                            term: request.term,
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
                                    $(this).autocomplete('widget').css('z-index', 1050);
                                    $('.ui-autocomplete').appendTo('body');
                                }
                            });
                        });
                    </script>
@endsection



<!-- MODALS DE LA PAGINA DE AQUI PARA ABAJO MI PANA RABBIT  -->
<div class="modal fade" id="sumarExperienciaModal" tabindex="-1" aria-labelledby="sumarExperienciaLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg"> <!-- Agregamos modal-lg para que sea más ancho -->
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="sumarExperienciaLabel">Sumar experiencia</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>
      <div class="modal-body">
          <!-- Formulario para sumar experiencia -->
          <form action="{{route('user-experience.store')}}" method="POST">
              @csrf
              <input type="hidden" name="user_id" value="{{ auth()->id() }}">
              <div class="row">
                  <div class="col-md-4">
                      <label for="company_name" class="form-label">Empresa</label>
                      <input type="text" class="form-control" id="company_name" name="company_name" data-autocomplete-url="{{route('api.companies.autocomplete')}}">

                  </div>
                  <div class="col-md-4">
                      <label for="company_activity" class="form-label">Actividad de la empresa</label>
                      <select id="company_activity" name="company_activity" class="form-control">
                            <option value="Administracion">Administración</option>
                            <option value="Agropecuario">Agropecuario</option>
                            <option value="Alimenticia">Alimenticia</option>
                            <option value="Ingenieria">Ingenieria</option>
                            <option value="Arquitectura">Arquitectura</option>
                            <option value="Agronomia">Agronomía</option>
                            <option value="Audiovisual">Audiovisual</option>
                            <option value="Comercio">Comercio</option>
                            <option value="Educacion">Educación</option> 
                            <option value="Hosteleria">Hostelería</option> 
                            <option value="Logistica">Logística</option> 
                            <option value="Medicina">Medicina</option> 
                            <option value="Salud">Salud</option> 
                            <option value="Tecnologia">Tecnología</option> 
                            <option value="Transporte">Transporte</option>
                            <option value="Mineria">Mineria</option>
                      </select>
                  </div>
                  <div class="col-md-4">
                      <label for="job" class="form-label">Puesto</label>
                      <input type="text" class="form-control" id="job" name="job">
                  </div>
              </div>

              <div class="row mt-3">
                  
                  <div class="col-md-4">
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
                  <div class="col-md-4">
                      <label for="job_sub_area" class="form-label">Subárea</label>
                      <select id="job_sub_area" name="job_sub_area" class="form-control">
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
                          <option value="Informatica">Informatica</option>
                      </select>
                  </div>
              </div>

              <div class="row mt-3">
                  <div class="col-md-4">
                      <label for="state" class="form-label">Region</label>
                      <select class="form-control" id="state_select_1" name="state_name">
                        <option value="">Seleccione una región</option>
                        <!-- Las opciones se llenarán dinámicamente -->
                    </select>
                  </div>
                  <div class="col-md-4">
                    <label for="province" class="form-label">Provincia</label>
                    <select class="form-control" id="province_select_1" name="province_name">
                        <option value="">Seleccione una provincia</option>
                        <!-- Las opciones se llenarán dinámicamente -->
                    </select>
                </div>
                <div class="col-md-4">
                      <label for="city" class="form-label">City</label>
                      <select class="form-control" id="city_select_1" name="city_name">
                        <option value="">Seleccione una ciudad</option>
                        <!-- Las opciones se llenarán dinámicamente -->
                    </select>
                  </div>
              </div>
              <div class="row mt-3">
                <div class="col-md-4">
                    <label class="form-label">Fecha de inicio</label>
                    <div class="row">
                        <div class="col-6">
                            <input type="date" name="start_date" class="form-control" placeholder="Fecha">
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                  <label class="form-label">Fecha de finalización</label>
                  <div class="row">
                      <div class="col-6">
                          <input type="date" name="finish_date" class="form-control" placeholder="Fecha" max="{{ date('Y-m-d') }}" value="{{ $fechaActual->format('Y-m-d') }}">
                      </div>
                  </div>
              </div>
              </div>
              <div class="mt-3">
                    <label class="form-label">Persona a cargo:</label>
                        <div class="row">
                            <div class="col-6">
                                <input type="text" name="person_in_charge" class="form-control" placeholder="Nombre">
                            </div>
                        </div>
              </div>

              {{--<div class="mt-3">
                  <input type="checkbox" name="presente" id="presente" value="si">
                  <label for="presente">Actualmente trabajando aquí</label>
              </div>--}}

              

              <div class="mt-3">
                <label for="description" class="form-label">Descripción de responsabilidades</label>
                <textarea class="form-control" id="description" name="description" rows="4"></textarea>
            </div>
            
            <div class="mt-3">
                <label for="current" class="form-label">¿Es actualmente empleado aquí?</label>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="current" name="current" value="1">
                    <label class="form-check-label" for="current">
                        Sí
                    </label>
                </div>
            </div>
            
              <div class="d-flex justify-content-end mt-3">
                  <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">Cancelar</button>
                  <input class="btn btn-primary" type="submit" value="Guardar"/>
              </div>
          </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="sumarEducacionModal" tabindex="-1" aria-labelledby="sumarEducacionModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="sumarEducacionModalLabel">Agregar Educación</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="educacionForm" method="POST" action="{{route('user-education.store')}}">
                    @csrf
                    <!-- Título o Carrera -->
                    
                    <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="career" class="form-label">Título o Carrera*</label>
                            <input type="text" class="form-control" id="career" name="career">
                        </div>
                    <!-- Institución -->
                    <div class="mb-3">
                        <label for="institution" class="form-label">Institución*</label>
                        <select class="form-control" id="institution" name="institution" required>
                            <option value="">Seleccione una institución</option>
                            <!-- Las opciones se llenarán dinámicamente -->
                        </select>
                    </div>
                    
                        <div class="mb-3">
                            <label for="type_of_study" class="form-label">Tipo de Estudio*</label>
                            <select class="form-control" id="type_of_study" name="type_of_study" required>
                                <option value="">Seleccione un tipo de estudio</option>
                                <!-- Las opciones se llenarán dinámicamente -->
                            </select>
                        </div>
                    </div>
                    <!-- Tipo de Estudio -->
                    <div class="row">
                        
                        <!-- Área de Estudio -->
                        <div class="col-md-6 mb-3">
                            <label for="area_of_study" class="form-label">Área de Estudio*</label>
                            <select class="form-control" id="area_of_study" name="area_of_study" required>
                                <option value="">Seleccione un área de estudio</option>
                                <!-- Las opciones se llenarán dinámicamente -->
                            </select>
                        </div>



                        <div class="col-md-6 mb-3">
                            <label for="subarea_of_study" class="form-label">Subárea de Estudio</label>
                            <select class="form-control" id="subarea_of_study" name="subarea_of_study" required>
                                <option value="">Seleccione un subárea de estudio</option>
                                <!-- Las opciones se llenarán dinámicamente -->
                            </select>
                        </div>

                    </div>
                    

                    <!-- Estado -->
                    <div class="mb-3">
                        <label for="status" class="form-label">Estado*</label>
                        <select class="form-control" id="status" name="status" required>
                            <option value="En curso">En curso</option>
                            <option value="Finalizado">Finalizado</option>
                            <option value="Abandonado">Abandonado</option>
                        </select>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="start_date" class="form-label">Fecha de Inicio*</label>
                        <input type="date" class="form-control" id="start_date" name="start_date" max="{{ date('Y-m-d') }}" required>
                    </div>

                    <div class="col-md-3 mb-3">
                        <label for="finish_date" class="form-label">Fecha de Finalizacion*</label>
                        <input type="date" name="finish_date" id="finish_date" class="form-control" max="{{ date('Y-m-d') }}" required>
                    </div>

                    <script>
                        document.getElementById('start_date').addEventListener('change', function() {
                            var startDate = this.value;
                            document.getElementById('finish_date').setAttribute('min', startDate);
                        });
                    </script>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <input class="btn btn-primary" type="submit" value="Guardar"/>{{--<button type="button" class="btn btn-primary">Guardar</button>--}}
                </div>
                </form>
            </div>
            
        </div>
    </div>
</div>


<!-- Modal para añadir un idioma -->
<div class="modal fade" id="Sumarlenguajemodal" tabindex="-1" aria-labelledby="Sumarlenguajemodal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="Sumarlenguajemodal">Añadir Idioma</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="POST" action="{{route('user-language.store')}}">
            @csrf
            <input type="hidden" name="user_id" value="{{ auth()->id() }}">
          <!-- Campo para el nombre del idioma -->
          <div class="mb-3">
            <label for="name" class="form-label">Nombre del Idioma</label>
            <input type="text" class="form-control" id="language_name" name="language_name" placeholder="Escribe el nombre del idioma">
          </div>

          <!-- Selector para el nivel escrito -->
          <div class="mb-3">
            <label for="written_level" class="form-label">Nivel Escrito</label>
            <select class="form-select" id="written_level" name="written_level">
              <option value="Basico">Básico</option>
              <option value="Intermedio">Intermedio</option>
              <option value="Avanzado">Avanzado</option>
              <option value="Nativo">Nativo</option>
            </select>
          </div>

          <!-- Selector para el nivel oral -->
          <div class="mb-3">
            <label for="oral_level" class="form-label">Nivel Oral</label>
            <select class="form-select" id="oral_level" name="oral_level">
              <option value="Basico">Básico</option>
              <option value="Intermedio">Intermedio</option>
              <option value="Avanzado">Avanzado</option>
              <option value="Nativo">Nativo</option>
            </select>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            <input class="btn btn-primary" type="submit" value="Guardar"/>
          </div>
        </form>
      </div>
      
    </div>
  </div>
</div>






<!--MODALES DE SOLO VISTA-->

<div class="modal fade" id="VisualizarLenguajeModal" tabindex="-1" aria-labelledby="VisualizarLenguajeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="VisualizarLenguajeModalLabel">Detalles del Idioma</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <!-- Aquí se mostrarán los datos del idioma en lugar de los campos de formulario -->
          <div class="mb-3">
            <label for="name" class="form-label">Nombre del Idioma:</label>
            <p id="name" class="form-value">Español</p> <!-- Asumiendo que "Español" es el dato a mostrar -->
          </div>
  
          <div class="mb-3">
            <label for="written_level" class="form-label">Nivel Escrito:</label>
            <p id="written_level" class="form-value">Avanzado</p> <!-- Asumiendo "Avanzado" como el dato a mostrar -->
          </div>
  
          <div class="mb-3">
            <label for="oral_level" class="form-label">Nivel Oral:</label>
            <p id="oral_level" class="form-value">Intermedio</p> <!-- Asumiendo "Intermedio" como el dato a mostrar -->
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>
  
  <div class="modal fade" id="sumarHabilidadesModal" tabindex="-1" aria-labelledby="sumarHabilidadesModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="sumarHabilidadModalLabel">Agregar Habilidad</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{route('user-skills.store')}}">
                @csrf
                <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Habilidad</label>
                        <input type="text" class="form-control" id="skill_name" name="skill_name" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>


