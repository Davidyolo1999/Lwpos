@extends('layouts.theme.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <h5>
                        <div class="card-header">{{ __('Home') }}</div>
                    </h5>

                    <div class="card-body text-center">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <h5>


                            {{ __('¡Ha iniciado la sesión!') }}
                            <div class="text-center">{{ Auth::user()->name }}</div>
                        </h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
