@extends('layouts.theme.app')

@section('content')
<h1>Cambio de contraseña</h1>

<form method="POST" action="{{ route('password.contraseña',$pass->id) }}">
    @csrf    
    @method('put') 
    <input type="hidden" name="name" value="{{ $pass->name }}">
    <input type="hidden" name="email" value="{{ $pass->email }}">
    <div class="form-row">
      <div class="form-group col-md-6">
        <b><label for="inputPassword4">Contraseña Nueva</label></b>
        <input type="password" class="form-control"  id="password" name="password" value="" placeholder="Contraseña" >
        @error('password')<!-- sirve para ver si ha ocurrido un erro en los campos-->
            <small>
                *{{$message}}
            </small>
         @enderror
      </div>
      <div class="form-group col-md-6">
        <b> <label for="inputPassword4">Confirmar Contraseña</label></b>
       

        <input type="password" class="form-control"  id="password_confirmation" name="password_confirmation" value="" placeholder="Confirmar Contraseña" >
         @error('password_confirmation')<!-- sirve para ver si ha ocurrido un erro en los campos-->
             <small>
                *{{$message}}
             </small>
            @enderror
      </div>
      
    </div>
    
    <button type="submit" class="btn btn-primary">Actualizar</button>
  </form>
@endsection

