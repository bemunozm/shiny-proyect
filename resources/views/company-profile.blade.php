@extends('layouts.user_type.auth')

@section('content')

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
                            {{$id->name}} {{$id->last_name}}
                        </h5>
                        <p class="mb-0 font-weight-bold text-sm">
                            {{$id->company->corporate_name }}
                        </p>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3">
                    <div class="nav-wrapper position-relative end-0">
                        <ul class="nav nav-pills nav-fill p-1 bg-transparent" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link mb-0 px-0 py-1 active" data-bs-toggle="tab" href="#empresa-panel" role="tab">
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

                          
                                    <span class="ms-1">{{ __('Empresa') }}</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link mb-0 px-0 py-1  " data-bs-toggle="tab" href="#perfil-panel" role="tab">
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
                        <div class="tab-pane active show" id="empresa-panel">
                            <div class="card">
                                <div class="card-header pb-0 px-3">
                                    <h6 class="mb-0">{{ __('Empresa') }}</h6>
                                </div>
                                <div class="card-body pt-4 p-3">
                                    <!-- Formulario para Perfil -->
                                    <form action="{{route('company.update', $id->company->id)}}" method="POST">
                                        @method('PUT')
                                        @csrf
                                        
                                        {{--NUMERO DE DOCUMENTO--}}
                                        
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                            <label for="name">Nombre de la empresa</label>
                                            <input type="text" class="form-control" placeholder="Ejemplo" name="name" id="name" aria-label="Name" aria-describedby="name" value="{{$id->company->name}}">
                                            @error('name')
                                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                            @enderror
                                            </div>
                                            <div class="col-md-6 mb-3">
                                            <label for="corporate_name">Razon social</label>
                                            <input type="text" class="form-control" placeholder="Ejemplo" name="corporate_name" id="corporate_name" aria-label="corporate_name" aria-describedby="corporate_name" value="{{$id->company->corporate_name}}">
                                            @error('corporate_name')
                                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                            @enderror
                                            </div>
                                        </div>
                                        
                                    <div class="row align-items-center">
                                        <div class="col-md-4 mb-3">
                                            <label for="tax">Condicion Fiscal</label>
                                        <select class="form-control" name="tax" id="tax">
                                            <option value="Contribuyente" {{ $id->company->tax == 'Contribuyente' ? 'selected' : '' }}>Contribuyente</option>
                                            <option value="No Contribuyente" {{ $id->company->tax == 'No Contribuyente' ? 'selected' : '' }}>No Contribuyente</option>
                                        </select>
                                        @error('tax')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="document">Documento</label>
                                        <input type="text" class="form-control" placeholder="1111111" name="document" id="document" aria-label="document" value="{{$id->company->document}}">
                                        @error('document')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="col-md-1" style="display: flex; align-items: center; justify-content: center;">
                                        -
                                    </div>
                                        <div class="col-md-1 mb-3">
                                            <label for="verifier_code"> </label>
                                            <input type="text" class="form-control" placeholder="0" name="verifier_code" id="verifier_code" aria-label="verifier_code" value="{{$id->company->verifier_code}}">
                                            @error('verifier_code')
                                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    {{--INFORMACION RESIDENCIAL--}}
                                    <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <label for="street_name">Direccion</label>
                                        <input type="text" class="form-control" placeholder="Los Algarrobos" name="street_name" id="street_name" value="{{$id->company->street_name}}">
                                        @error('street_name')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="number">Numero</label>
                                        <input type="number" class="form-control" placeholder="#3410" name="number" id="number" aria-label="number" value="{{$id->company->number }}">
                                        @error('number')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="City">Ciudad</label>
                                            <input type="String" class="form-control" placeholder="Iquique" name="City" id="City" aria-label="City" value="{{$id->company->city}}">
                                        @error('city')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                        </div>
                                    </div>
                                        <div class="mb-3">
                                        <label for="phone">Telefono</label>
                                        <input type="number" class="form-control" placeholder="961231277" name="phone" id="phone" value="{{$id->company->phone}}">
                                        @error('phone')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="industry">Industria</label>
                                        <input type="text" class="form-control" placeholder="Industria Minera" name="industry" id="industry" value="{{$id->company->industry}}">
                                        @error('industry')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                        
                                        <div class="d-flex justify-content-end">
                                            <input type="submit" class="btn bg-gradient-dark btn-md mt-4 mb-4" value="Guardar Cambios"></input>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>    
                    
                        <div class="tab-panel fade" id="perfil-panel">
                            <div class="card">
                                <div class="card-header pb-0 px-3">
                                    <h6 class="mb-0">{{ __('Perfil') }}</h6>
                                </div>
                                <div class="card-body pt-4 p-3">
                                    <!-- Formulario para Perfil -->
                                    <form action="{{route('company_update', $id)}}" method="POST">
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
                                        <br/><h5>Informacion Residencia</h5><br/>
                                        {{--INFORMACION DE RESIDENCIA--}}
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="state_select">{{ __('Region') }}</label>
            <select id="state_select" name="state" class="form-control">
                <option value="">Seleccione una región</option>
                <!-- Las opciones se llenarán dinámicamente -->
            </select>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="province_select">{{ __('Provincia') }}</label>
            <select id="province_select" name="province" class="form-control">
                <option value="">Seleccione una provincia</option>
                <!-- Las opciones se llenarán dinámicamente -->
            </select>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="city_select">{{ __('Ciudad') }}</label>
            <select id="city_select" name="city" class="form-control">
                <option value="">Seleccione una ciudad</option>
                <!-- Las opciones se llenarán dinámicamente -->
            </select>
        </div>
    </div>
</div>


                                        <br/><h5>Otra Informacion</h5><br/>
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
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


<script src="ruta/a/bootstrap.min.js"></script>
<script> 
$(document).ready(function() {
    // Cargar regiones al inicializar
    loadStates();

    // Evento change para el selector de Región (State)
    $('#state_select').change(function() {
        var stateId = $(this).val();
        if (stateId) {
            loadProvinces(stateId);
        } else {
            $('#province_select').empty().append('<option value="">Seleccione una provincia</option>');
            $('#city_select').empty().append('<option value="">Seleccione una ciudad</option>');
        }
    });

    // Evento change para el selector de Provincia (Province)
    $('#province_select').change(function() {
        var provinceId = $(this).val();
        if (provinceId) {
            loadCities(provinceId);
        } else {
            $('#city_select').empty().append('<option value="">Seleccione una ciudad</option>');
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
                // Si hay una región preseleccionada, cárgala aquí
                stateSelect.val("{{$id->state}}");
                if (stateSelect.val()) {
                    loadProvinces(stateSelect.val());
                }
            }
        });
    }

    // Función para cargar las provincias basadas en la región seleccionada
    function loadProvinces(stateId) {
    $.ajax({
        url: "/search-province",
        type: "GET",
        dataType: "json",
        data: { region_id: stateId }, // Cambiado de 'state_id' a 'region_id'
        success: function(data) {
            var provinceSelect = $('#province_select');
            provinceSelect.empty().append('<option value="">Seleccione una provincia</option>');
            $.each(data, function(i, item) {
                provinceSelect.append(new Option(item.name, item.id)); // 'item.name' está bien porque usas 'provincia as name'
            });
            provinceSelect.val("{{$id->province}}"); // Set preselected province if any
            if (provinceSelect.val()) {
                loadCities(provinceSelect.val()); // Automatically load cities for the preselected province
            }
        }
    });
}



    // Función para cargar las ciudades basadas en la provincia seleccionada
    function loadCities(provinceId) {
        $.ajax({
            url: "{{ route('searchCity') }}",
            dataType: "json",
            data: { province_id: provinceId },
            success: function(data) {
                var citySelect = $('#city_select');
                citySelect.empty().append('<option value="">Seleccione una ciudad</option>');
                $.each(data, function(i, item) {
                    citySelect.append(new Option(item.name, item.id));
                });
                // Si hay una ciudad preseleccionada, cárgala aquí
                citySelect.val("{{$id->city}}");
            }
        });
    }
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
                      <input type="text" class="form-control" id="company_name" name="company_name">
                  </div>
                  <div class="col-md-4">
                      <label for="company_activity" class="form-label">Actividad de la empresa</label>
                      <select id="company_activity" name="company_activity" class="form-control">
                          <option value="administracion">Administración</option>
                          <option value="agropecuario">Agropecuario</option>
                          <option value="alimenticia">Alimenticia</option>

                      </select>
                  </div>
                  <div class="col-md-4">
                      <label for="job" class="form-label">Puesto</label>
                      <input type="text" class="form-control" id="job" name="job">
                  </div>
              </div>

              <div class="row mt-3">
                  <div class="col-md-4">
                      <label for="work_experience" class="form-label">Experiencia (En meses)</label>
                      <input type="number" class="form-control" id="work_experience" name="work_experience">
                  </div>
                  <div class="col-md-4">
                      <label for="job_area" class="form-label">Área del puesto</label>
                      <select id="job_area" name="job_area" class="form-control">
                          <option value="abastecimiento">Abastecimiento</option>
                          <option value="logistica">Logística</option>
                          <!-- ... (otros valores) ... -->
                      </select>
                  </div>
                  <div class="col-md-4">
                      <label for="job_sub_area" class="form-label">Subárea</label>
                      <select id="job_sub_area" name="job_sub_area" class="form-control">
                          <option value="abastecimiento">Abastecimiento</option>
                          <option value="logistica">Logística</option>
                      </select>
                  </div>
              </div>

              <div class="row mt-3">
                  <div class="col-md-4">
                      <label for="country" class="form-label">País</label>
                      <input type="text" class="form-control" id="country" name="country">
                  </div>
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
                              <input type="date" name="finish_date" class="form-control" placeholder="Fecha">
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
                            <input type="text" class="form-control" id="career" name="career" required>
                        </div>
                        <!-- País -->
                        <div class="col-md-6 mb-3">
                            <label for="country" class="form-label">País*</label>
                            <input type="text" class="form-control" id="country" name="country" required>
                        </div>
                    </div>
                    <!-- Tipo de Estudio -->
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="type_of_study" class="form-label">Tipo de Estudio*</label>
                            <select class="form-control" id="type_of_study" name="type_of_study" required>
                                <option value="Pregrado">Pregrado</option>
                                <option value="Maestría">Maestría</option>
                                <option value="Doctorado">Doctorado</option>
                            </select>
                        </div>
                        <!-- Área de Estudio -->
                        <div class="col-md-6 mb-3">
                            <label for="area_of_study" class="form-label">Área de Estudio*</label>
                            <select class="form-control" id="area_of_study" name="area_of_study" required>
                                <option value="Ciencias">Ciencias</option>
                                <option value="Artes">Artes</option>
                                <option value="Humanidades">Humanidades</option>
                                <option value="Ingeniería">Ingeniería</option>
                                <!-- Otros -->
                            </select>
                        </div>
                    </div>
                    <!-- Institución -->
                    <div class="mb-3">
                        <label for="institution" class="form-label">Institución*</label>
                        <input type="text" class="form-control" id="institution" name="institution" required>
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
                    <div class="row">
                    <!-- Fecha de Inicio -->
                    <div class="col-md-3 mb-3">
                        <label for="start_date" class="form-label">Fecha de Inicio*</label>
                        <input type="date" class="form-control" id="start_date" name="start_date" placeholder="Mes" required>
                    </div>
                    <!-- Fecha de Finalización -->
                    <div class="col-md-3 mb-3">
                        <label for="finish_date" class="form-label">Fecha de Finalizacion*</label>
                        <input type="date" class="form-control" id="finish_date" name="finish_date" placeholder="Mes" required>
                    </div>
                </div>
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
            <input type="text" class="form-control" id="name" name="name" placeholder="Escribe el nombre del idioma">
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
