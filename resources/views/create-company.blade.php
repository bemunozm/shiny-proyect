@extends('layouts.app')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Shiny</title>
</head>
<body>
    
    <section class="min-vh-100 mb-8">
        <div class="page-header align-items-start min-vh-50 pt-5 pb-11 mx-3 border-radius-lg" style="background-image: url('../assets/img/curved-images/curved14.jpg');">
          <span class="mask bg-gradient-dark opacity-6"></span>
          <div class="container">
            <div class="row justify-content-center">
              <div class="col-lg-5 text-center mx-auto">
                <h1 class="text-white mb-2 mt-5">¡Registra tu Empresa!</h1>
                <p class="text-lead text-white">Y encuentra los colaboradores ideales.</p>
              </div>
            </div>
          </div>
        </div>
        <div class="container">
          <div class="row mt-lg-n10 mt-md-n11 mt-n10">
            <div class="col-xl-10 col-lg-5 col-md-7 mx-auto">
              <div class="card z-index-0">
                <div class="card-header text-center pt-4">
                    <h5>Ingresa los datos de la empresa</h5>
                  </div>
                <div class="card-body">
                  <form role="form text-left" method="POST" action="{{route('company.store')}}">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                        <label for="name">Nombre de la empresa</label>
                        <input type="text" class="form-control" placeholder="Ejemplo" name="name" id="name" aria-label="Name" aria-describedby="name" value="{{ old('name') }}">
                        @error('name')
                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                        @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                        <label for="corporate_name">Razon social</label>
                        <input type="text" class="form-control" placeholder="Ejemplo" name="corporate_name" id="corporate_name" aria-label="corporate_name" aria-describedby="corporate_name" value="{{ old('corporate_name') }}">
                        @error('corporate_name')
                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                        @enderror
                        </div>
                    </div>
                    
                  <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="tax">Condicion Fiscal</label>
                    <select class="form-control" name="tax" id="tax">
                        <option value="Contribuyente">Contribuyente</option>
                        <option value="No Contribuyente">No Contribuyente</option>
                    </select>
                    @error('tax')
                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                    @enderror
                  </div>
                  <div class="col-md-4 mb-3">
                    <label for="document">Documento</label>
                      <input type="text" class="form-control" placeholder="1111111" name="document" id="document" aria-label="document" value="{{ old('document') }}">
                      @error('document')
                          <p class="text-danger text-xs mt-2">{{ $message }}</p>
                      @enderror
                  </div>
                      <div class="col-md-1 mb-3">
                        <label for="verifier_code"></label>
                          <input type="text" class="form-control" placeholder="0" name="verifier_code" id="verifier_code" aria-label="verifier_code" value="{{ old('verifier_code') }}">
                          @error('verifier_code')
                              <p class="text-danger text-xs mt-2">{{ $message }}</p>
                          @enderror
                      </div>
                  </div>
                  {{--INFORMACION RESIDENCIAL--}}
                <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="street_name">Direccion</label>
                    <input type="text" class="form-control" placeholder="Los Algarrobos" name="street_name" id="street_name" value="{{ old('street_name') }}">
                    @error('street_name')
                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                    @enderror
                </div>
                    <div class="col-md-4 mb-3">
                        <label for="number">Numero</label>
                      <input type="number" class="form-control" placeholder="#3410" name="number" id="number" aria-label="number" value="{{ old('number') }}">
                      @error('number')
                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                      @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="zip_code">Codigo Postal</label>
                        <input type="number" class="form-control" placeholder="1100000" name="zip_code" id="zip_code" aria-label="zip_code" value="{{ old('zip_code') }}">
                      @error('zip_code')
                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                      @enderror
                    </div>
                </div>
                    <div class="mb-3">
                    <label for="phone">Telefono</label>
                    <input type="number" class="form-control" placeholder="961231277" name="phone" id="phone" value="{{ old('phone') }}">
                    @error('phone')
                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <label for="industry">Industria</label>
                    <input type="text" class="form-control" placeholder="Industria Minera" name="industry" id="industry" value="{{ old('industry') }}">
                    @error('industry')
                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                    @enderror
                </div>
                <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                    <div class="text-center">
                      <button type="submit" class="btn bg-gradient-dark w-100 my-4 mb-2">Registrar</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>



</body>
</html>