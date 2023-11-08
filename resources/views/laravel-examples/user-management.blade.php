@extends('layouts.user_type.auth')

@section('content')

<div>
    <div class="row">
        <div class="col-12">
            <div class="card mb-4 mx-4">
                <div class="card-header pb-0">
                    <div class="d-flex flex-row justify-content-between">
                        <div>
                            <h5 class="mb-0">Postulantes</h5>
                        </div>
                    </div>
                </div>
                <div class="card-header">
                <form method="GET" action="{{ route('resume.filter') }}">
                        <div class="row">
                            <div class="col">
                                <input type="text" name="country" class="form-control" placeholder="País">
                            </div>
                            <div class="col">
                                <input type="text" name="type_of_study" class="form-control" placeholder="Estudios">
                            </div>
                            <div class="col">
                                <input type="text" name="skill" class="form-control" placeholder="Habilidad">
                            </div>
                            <div class="col">
                                <button type="submit" class="btn btn-primary">Buscar</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Nombres
                                    </th>
                                    
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Empleo
                                    </th>

                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Estudios
                                    </th>
                                    
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Pais
                                    </th>
                                    
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        habilidades
                                    </th>
                                    
                                </tr> 
                            </thead>
                            <tbody>
                                @foreach ($resumes as $resume)
                                @if ($resume->user_id && $resume->user)
                                    <tr>
                                        <td class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            {{ $resume->user->name }}
                                            {{ $resume->user->last_name }}
                                        </td>
                                        <td class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            @php
                                                $currentExperience = $resume->experiences->firstWhere('current', 1);
                                            @endphp
                                            {{ $currentExperience ? $currentExperience->job : 'Sin Empleo Actual' }}
                                            {{ $currentExperience ? $currentExperience->job_area : '' }}
                                            
                                            
                                        </td>
                                        <td class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            {{ $resume->educations->first()->career ?? 'Sin Estudios'  }}
                                        </td>
                                        <td class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            {{ $resume->user->country }}
                                        </td>
                                        <td class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            @if($resume->skills->isNotEmpty())
                                                @foreach($resume->skills as $skill)
                                                    {{ $skill->name }}@if(!$loop->last), @endif
                                                @endforeach
                                            @else
                                                Sin Habilidades
                                            @endif
                                        </td>
                                        <td class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            <a href="{{ route('show-profile', $resume->user->id) }}" class="btn btn-link btn-sm">Ver detalles</a>
                                        </td>
                                    </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
