@extends('layouts.admin')
@section('contenido')
    <div class="row justify-content-center">
        <div class="col-lg-3 col-md-6">
            <a href="{{ url('reportes') }}">
                <div class="card card-new" style="width: 18rem;">
                    <img class="card-img-top" src="{{ asset('img/Tours-web.webp') }}" alt="reportes"
                        loading="lazy">
                </div>
            </a>
        </div>
    </div>
@endsection
