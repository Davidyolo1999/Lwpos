@extends('layouts.theme.app')

@section('content')
    <h1>Perfil de Usuario</h1>
    <form action="{{ route('perfil.actualizar', $user->id) }} " method="POST">
        @csrf
        @method('put')
        <div class="form-group">
              <b> <label for="inputAddress" >NOMBRE COMPLETO</label> </b> 
                <input type="text" class="form-control" id="name" value="{{ old('name', $user->name) }}" name="name">
            

        </div>
        @error('name')
            <!-- sirve para ver si ha ocurrido un erro en los campos-->
            <small>
                *{{ $message }}
            </small>
        @enderror
        <div class="form-group">
<b> <label for="inputEmail4">EMAIL</label> </b>
           
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}"
                placeholder="Email">
            @error('email')
                <!-- sirve para ver si ha ocurrido un erro en los campos-->
                <small>
                    *{{ $message }}
                </small>
            @enderror

        </div>
        <div class="form-group">
<B>  <label for="inputEmail4">TELEFONO</label></B>
          
            <input type="phone" class="form-control" id="phone" name="phone" value="{{ old('phone', $user->phone) }}"
                placeholder="Phone">
            @error('phone')
                <!-- sirve para ver si ha ocurrido un erro en los campos-->
                <small>
                    *{{ $message }}
                </small>
            @enderror

        </div>

        <div class="form-group">
<b>   <label for="inputEmail4">PERFIL</label></b>
         
            <input type="profile" class="form-control" id="profile" name="profile" value="{{ old('profile', $user->profile) }}"
                placeholder="Profile">
            @error('email')
                <!-- sirve para ver si ha ocurrido un erro en los campos-->
                <small>
                    *{{ $message }}
                </small>
            @enderror

        </div>

        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
@endsection
@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    
@stop



@section('js')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="sweetalert2.min.js"></script>
<script src="sweetalert2.all.min.js"></script>
<link rel="stylesheet" href="sweetalert2.min.css">
@if (session('password_update') == 'ok')
<script>
    Swal.fire(
          '¡Actualizado!',
          '!Contraseña actualizada con exito',
          'success'
        )
</script>  

    
@endif
@if (session('perfil_update') == 'ok')
<script>
    Swal.fire(
          '¡Actualizado!',
          '!Perfil actualizado con exito',
          'success'
        )
</script>  

    
@endif

@stop