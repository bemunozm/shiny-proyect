@extends('layouts.user_type.auth')

@section('content')

<div class="card">
    <div class="card-header pb-0 px-3">
        <h6 class="mb-0">{{$replacement->job_name}}</h6>
    </div>
    <div class="card-body pt-4 p-3">
<table class="table align-items-center mb-0">
    <thead>
        <tr>
            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">RUT</th>
            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">NOMBRES</th>
            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">PAIS</th>
            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">CONTACTO</th>
            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">AFINIDAD</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($sortedResumes as $resume)
            <tr>
                <td>
                    <span class="badge badge-dot me-4">
                        <i class="bg-info"></i>
                        <span class="text-dark text-xs">{{$resume->user->document}}</span>
                        <span class="text-dark text-xs">-{{$resume->user->verifier_code}}</span>
                        
                    </span>
                </td>
                
                <td>
                    <span class="text-dark text-xs">{{$resume->user->name}}</span>
                    <span class="text-dark text-xs">{{$resume->user->last_name}}</span>
                </td>
                <td>
                    <p class="text-xs font-weight-normal mb-0">{{$resume->user->city}}</p>
                    <p class="text-xs font-weight-normal mb-0">{{$resume->user->country}}</p>
                </td>
                <td>

                    
                    
                    <p class="text-xs font-weight-normal mb-0">{{$resume->user->phone}}</p>
                    <p class="text-xs font-weight-normal mb-0">{{$resume->user->email}}</p>

                </td>

                <td>
                    <div class="progress-wrapper">
                      <div class="progress-info">
                        <div class="progress-percentage">
                          <!-- Calcular el porcentaje y mostrarlo -->
                          <span class="text-sm font-weight-normal">{{ round(($resume->affinityScore * 100)/ $maximumScore, 2) }}%</span>
                        </div>
                      </div>
                      <div class="progress">
                        <!-- Establecer el valor de 'aria-valuenow' y el ancho de la barra de progreso según el porcentaje -->
                        <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="{{ round(($resume->affinityScore * 100)/ $maximumScore, 2) }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ round(($resume->affinityScore / $maximumScore) * 100, 2) }}%;"></div>
                      </div>
                    </div>
                </td>
                
                <td class="align-middle">
                    
                    <button type="button" class="btn bg-gradient-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                        Opciones
                    </button>
                    <ul class="dropdown-menu px-2 py-3" aria-labelledby="dropdownMenuButton">
                        <li><a href="{{ route('show-profile', $resume->user->id) }}" class="btn btn-link btn-sm">Ver detalles</a></li>
                        
                        
                    </ul>
                    
                      
                </td>
                {{--<td class="align-middle">
                    
                    <button type="button" class="btn bg-gradient-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                        Opciones
                    </button>
                    <ul class="dropdown-menu px-2 py-3" aria-labelledby="dropdownMenuButton">
                        <li><a class="dropdown-item border-radius-md" href="{{route('replacement.index', $replacement->id)}}">Ver Postulantes</a></li>
                        <li><a class="dropdown-item border-radius-md" href="{{route('replacement.show', $replacement->id)}}">Modificar</a></li>
                        <li>
                            <form action="{{ route('replacement.destroy', $replacement->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="dropdown-item border-radius-md">Eliminar</button>
                            </form>
                        </li>
                    </ul>
                    
                      
                </td>--}}
            </tr>
        @endforeach
    </tbody>
</table>
    </div>
</div>
@endsection