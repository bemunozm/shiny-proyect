@extends('layouts.user_type.auth')

@section('content')
<div class="container mt-4">
    <!-- Filtro Recuadro -->
    <div class="card mb-4">
        <div class="card-header">
            Bolsa de empleos
        </div>
        <div class="card-body">
            <form>
                <div class="row">
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="empresa" class="form-label">Fecha</label>
                            <input type="text" class="form-control" id="empresa" name="empresa" placeholder="Nombre de la empresa">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="estado" class="form-label">Area</label>
                            <select class="form-select" id="estado" name="estado">
                                <option selected disabled>Selecciona un estado</option>
                                <option value="working">Working</option>
                                <option value="done">Done</option>
                                <option value="canceled">Canceled</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="presupuesto" class="form-label">Region</label>
                            <input type="number" class="form-control" id="presupuesto" name="presupuesto" placeholder="Presupuesto mínimo">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="presupuesto" class="form-label">Modalidad de trabajo</label>
                            <input type="number" class="form-control" id="presupuesto" name="presupuesto" placeholder="Presupuesto mínimo">
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Aplicar Filtros</button>
            </form>
        </div>
    </div>

    <!-- Tu Tabla Aquí -->
    <div class="card">
        <div class="card-header">
            Resultados
        </div>
        <div class="table-responsive">
            <table class="table align-items-center mb-0">
                <thead>
                    <tr>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Titulo</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Fecha</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Lugar</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Modalidad de Trabajo</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection