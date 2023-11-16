@extends('layouts.user_type.auth')

@section('content')

<!-- Tarjeta con Tabla -->
<div class="card">
  <!-- Título de la Tabla dentro de la tarjeta -->
  <div class="card-header">
    <h4 class="text-primary"> <!-- Agregando clase para color azul -->
      <i class="fas fa-briefcase"></i> <!-- Icono de Font Awesome -->
      Mis postulaciones
    </h4>
  </div>
  
  <!-- Contenido de la Tabla -->
  <div class="table-responsive">
    <table class="table align-items-center mb-0">
      <thead>
        <tr>
          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Título</th>
          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Área</th>
          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Sub Área</th>
          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Ubicación</th>
          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Salario</th>
          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Acciones</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($applications as $application)
          <tr>
            <td class="text-xs font-weight-bold mb-0">{{ $application->job_name }}</td>
            <td class="text-xs font-weight-bold mb-0">{{ $application->job_area }}</td>
            <td class="text-xs font-weight-bold mb-0">{{ $application->job_sub_area }}</td>
            <td class="text-xs font-weight-bold mb-0">{{ $application->city}},{{ $application->province }},{{ $application->state }}</td></td></td>
            <td class="text-xs font-weight-bold mb-0">{{ $application->min_salary }} - {{ $application->max_salary }}</td>
            <td class="text-xs font-weight-bold mb-0">
              <form action="{{ route('eliminar.postulacion', $application->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
              </form>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="3" class="text-center">No hay postulaciones para mostrar.</td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>

@endsection