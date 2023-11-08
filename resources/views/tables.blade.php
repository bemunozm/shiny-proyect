@extends('layouts.user_type.auth')

@section('content')

<main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg">
    <div class="container-fluid py-4">

        <!-- Filtro para la búsqueda de empleos específicos -->
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>Buscar empleos</h6>
                        <form action="{{ route('empleos.buscar') }}" method="GET" class="row g-3">
                            <div class="col-md-3">
                                <input type="text" class="form-control" name="job_name" placeholder="Nombre del puesto">
                            </div>
                            <div class="col-md-2">
                                <select class="form-control" name="country">
                                    <option value="">Seleccione un país</option>
                                    @foreach ($countries as $country)
                                        <option value="{{ $country }}">{{ $country }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2">
                                <select class="form-control" name="state">
                                    <option value="">Seleccione un estado</option>
                                    @foreach ($states as $state)
                                        <option value="{{ $state }}">{{ $state }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2">
                                <select class="form-control" name="city">
                                    <option value="">Seleccione una ciudad</option>
                                    @foreach ($cities as $city)
                                        <option value="{{ $city }}">{{ $city }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <button type="submit" class="btn btn-primary">Buscar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabla de ofertas de trabajo -->
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>Tabla de ofertas de trabajo</h6>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Posición</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Área</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Sub Área</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Salario</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Experiencia</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Ubicación</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Publicado</th>
                                        <th class="text-secondary opacity-7"></th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($replacements as $replacement)
                                        <tr>
                                            <td>{{ $replacement->job_name }}</td>
                                            <td>{{ $replacement->job_area }}</td>
                                            <td class="text-center">{{ $replacement->job_sub_area }}</td>
                                            <td class="text-center">{{ $replacement->min_salary }} - {{ $replacement->max_salary }}</td>
                                            <td class="text-center">{{ $replacement->min_experience }} meses</td>
                                            <td class="text-center">{{ $replacement->city }}, {{ $replacement->state }}, {{ $replacement->country }}</td>
                                            <td class="text-center">{{ $replacement->created_at->format('d/m/Y') }}</td>
                                            <td class="text-end">
                                                <a href="{{ route('ver.empleo', $replacement->id) }}" class="btn btn-link btn-sm">Ver detalles</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</main>

@endsection