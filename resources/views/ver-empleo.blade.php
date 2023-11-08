@extends('layouts.user_type.auth')

@section('content')
@if (session('alert-error'))
    <div class="alert alert-danger">
        {{ session('alert-error') }}
    </div>
@endif

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
                <p>País: {{ $replacement->country }}</p>
                <p>Región: {{ $replacement->state }}</p>
                <p>Comuna: {{ $replacement->city }}</p>
                <p>Dirección: {{ $replacement->address }}</p>
            </div>
            <div class="mb-3">
                <strong>¿En qué consiste el puesto?:</strong>
                <p>{{ $replacement->job_description }}</p>
            </div>
            <div class="mb-3">
                <strong>¿Cuál es el rango salarial bruto que ofreces?:</strong>
                <p>Desde: ${{ number_format($replacement->min_salary, 2) }}</p>
                <p>Hasta: ${{ number_format($replacement->max_salary, 2) }}</p>
            </div>
            <div class="mb-3">
                <strong>¿Cuánto es el mínimo de experiencia?:</strong>
                <p>{{ $replacement->min_experience }} años</p>
            </div>
            <div class="modal-footer">
                <a href="{{ route('replacement.asignar', $replacement->id) }}" class="btn bg-gradient-primary">POSTULA AHORA</a>
            </div>
        </div>
    </div>
</div>

@endsection
