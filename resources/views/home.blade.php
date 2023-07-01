@extends('layouts.admin')
@section('contenido')
    <style>
        .card {
            position: relative;
        }

        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .card-title {
            color: #fff;
            font-size: 24px;
            text-align: center;
        }

        .card-img-top {
            transition: opacity 0.3s ease;
        }

        .card:hover .card-img-top {
            opacity: 0.8;
        }
    </style>

    <div class="row justify-content-center">
        <div class="col-lg-3 col-md-6">
            <a href="{{ url('reportes') }}">
                <div class="card card-new" style="width: 18rem;">
                    <div class="position-relative">
                        <img class="card-img-top"
                            src="https://www.mitviajes.com/wp-content/uploads/2019/09/Mulher-na-Trilha-Choquequirao-Peru-980x572.jpg"
                            alt="reportes" loading="lazy">
                        <div class="overlay">
                            <h5 class="card-title text-white">Reportes</h5>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
@endsection
