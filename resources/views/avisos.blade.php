@extends('layouts.user_type.auth')

@section('content')
<table class="table align-items-center mb-0">
    <thead>
        <tr>
            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Titulo</th>
            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Area</th>
            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Sub Area</th>
            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Lugar</th>
            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($company->replacements as $replacement)
            <tr>
                <td>
                    <span class="badge badge-dot me-4">
                        <i class="bg-info"></i>
                        <span class="text-dark text-xs">{{$replacement->job_name}}</span>
                        
                    </span>
                </td>
                
                <td>
                    <p class="text-xs font-weight-normal mb-0">{{$replacement->job_area}}</p>
                </td>
                <td>
                    <p class="text-xs font-weight-normal mb-0">{{$replacement->job_sub_area}}</p>
                </td>
                <td>

                    
                    <p class="text-xs font-weight-normal mb-0">{{$replacement->city}}</p>
                    <p class="text-xs font-weight-normal mb-0">{{$replacement->country}}</p>

                </td>
        
                <td class="align-middle">
                    
                    <button type="button" class="btn bg-gradient-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                        Opciones
                    </button>
                    <ul class="dropdown-menu px-2 py-3" aria-labelledby="dropdownMenuButton">
                        <li><a class="dropdown-item border-radius-md" href="{{route('replacement.mostrar', $replacement->id)}}">Ver Postulantes</a></li>
                        <li><a class="dropdown-item border-radius-md" href="{{route('replacement.show', $replacement->id)}}">Modificar</a></li>
                        <li>
                            <form action="{{ route('replacement.destroy', $replacement->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="dropdown-item border-radius-md">Eliminar</button>
                            </form>
                        </li>
                    </ul>
                    
                      
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection