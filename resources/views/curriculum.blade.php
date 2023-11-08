@extends('layouts.user_type.auth')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12 col-xl-4">
                <div class="card h-100">
                    <div class="card-header pb-0 p-3">
                        <h6 class="mb-0">Avisos</h6>
                        <div class="d-flex flex-column align-items-center mt-3">
                            <p class="mb-3">Aún no tienes avisos</p>
                            <button type="button" class="btn bg-gradient-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                Crear anuncio de trabajo
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title font-weight-normal" id="exampleModalLabel">Crear Anuncio de Trabajo</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form>
                                <!-- [Código del formulario] -->
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn bg-gradient-primary">Guardar Cambios</button>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-12 col-xl-4">
                <div class="card h-100">
                    <div class="card-header pb-0 p-3">
                        <div class="row">
                            <div class="col-md-8 d-flex align-items-center">
                                <h6 class="mb-0">Ultimos postulados</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-xl-4">
                <div class="card h-100">
                    <div class="card-header pb-0 p-3">
                        <h6 class="mb-0">Estadisticas</h6>
                    </div>
                </div>
            </div>
            <div class="col-12 mt-4">
                <div class="card mb-4">
                    <div class="card-header pb-0 p-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="mb-1">Busqueda en base</h6>
                                <p class="text-sm">Encuentra el candidato ideal en nuestra base de datos.</p>
                            </div>
                            <div class="d-flex align-items-center">
                                <input type="text" class="form-control" placeholder="Ingresa tu búsqueda">
                                <input type="text" class="form-control ms-2" placeholder="Lugar de trabajo">
                                <button type="button" class="btn bg-gradient-primary ms-2">Buscar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
