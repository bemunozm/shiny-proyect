<!-- Navbar -->
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
    <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
            <li class="breadcrumb-item text-sm text-dark active text-capitalize" aria-current="page">{{ str_replace('-', ' ', Request::path()) }}</li>
            </ol>
            <h6 class="font-weight-bolder mb-0 text-capitalize">{{ str_replace('-', ' ', Request::path()) }}</h6>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4 d-flex justify-content-end" id="navbar"> 
            <!-- Button trigger modal -->
            <div class="nav-item d-flex align-self-end">
                <a href="{{ route('replacement.create') }}" class="btn bg-gradient-primary">
                    Crear anuncio de trabajo
                </a>
                
                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title font-weight-normal" id="exampleModalLabel">Informacion del aviso</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form method="POST" action="{{route('replacement.store')}}">
                                    @csrf
                                    <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                                    <div class="mb-3">
                                        <label for="job_name" class="form-label">¿Qué puesto quieres cubrir?</label>
                                        <input type="text" class="form-control" id="job_name" name="job_name" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="job_area" class="form-label">Área del puesto</label>
                                        <input type="text" class="form-control" id="job_area" name="job_area" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="job_sub_area" class="form-label">Subárea del puesto</label>
                                        <input type="text" class="form-control" id="job_sub_area" name="job_sub_area" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="jobLocation" class="form-label">¿Dónde se encuentra el lugar del trabajo?</label>
                                        <input type="text" class="form-control" id="country" name="country" placeholder="País" required>
                                        <input type="text" class="form-control mt-2" id="state" name="state" placeholder="Región" required>
                                        <input type="text" class="form-control mt-2" id="city" name="city" placeholder="Comuna" required>
                                        <input type="text" class="form-control mt-2" id="address" name="address" placeholder="Dirección" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="job_description" class="form-label">¿En qué consiste el puesto?</label>
                                        <textarea class="form-control" id="job_description" name="job_description" rows="3" required></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="salaryRange" class="form-label">¿Cuál es el rango salarial bruto que ofreces?</label>
                                        <input type="number" class="form-control" id="min_salary" name="min_salary" placeholder="Mínimo" required>
                                        <input type="number" class="form-control mt-2" id="max_salary" name="max_salary" placeholder="Máximo" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="experience" class="form-label">¿Cuanto es el minimo de experiencia?</label>
                                        <input type="number" class="form-control" id="min_experience" name="min_experience" placeholder="Mínimo" required>
                                    </div>

                                    <!-- Campo para el nombre del idioma -->
                                </tr><h4>Idiomas requeridos</h4></tr>
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
                                        <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Cerrar</button>
                                        <button type="submit" class="btn bg-gradient-primary">Guardar Cambios</button>
                                    </div>
                                </form>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Button trigger modal -->
            <div class="ms-md-3 pe-md-3 d-flex align-items-center">
            
            </div>
            <ul class="navbar-nav  justify-content-end">
            <li class="nav-item d-flex align-items-center">
                <a href="{{ url('/logout')}}" class="nav-link text-body font-weight-bold px-0">
                    <i class="fa fa-user me-sm-1"></i>
                    <span class="d-sm-inline d-none">Sign Out</span>
                </a>
            </li>
            <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
                <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                <div class="sidenav-toggler-inner">
                    <i class="sidenav-toggler-line"></i>
                    <i class="sidenav-toggler-line"></i>
                    <i class="sidenav-toggler-line"></i>
                </div>
                </a>
            </li>
            <li class="nav-item px-3 d-flex align-items-center">
                <a href="javascript:;" class="nav-link text-body p-0">
                <i class="fa fa-cog fixed-plugin-button-nav cursor-pointer"></i>
                </a>
            </li>
            
            </ul>
        </div>
    </div>
</nav>
<!-- End Navbar -->