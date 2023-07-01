<html>

<head>
    <title>Paquete turistico para {{ $reporte->nombre }}</title>
    <link rel="icon" href="https://www.mitviajes.com/wp-content/uploads/2019/03/cropped-Favicon-Mit-Viajes.png" />
    <link href="{{ asset('admin/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.3.2/html2canvas.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/pdf.css') }}">

</head>

<body class="container">
    <div class="container">
        <div class="row linea">
            <div class="col-12">
                @php
                    $nombre = $reporte->nombre;
                    $fecha = $reporte->created_at->format('Y-m-d'); // Utiliza la fecha de creación del reporte
                    
                    $iniciales = '';
                    $palabras = explode(' ', $nombre);
                    
                    foreach ($palabras as $palabra) {
                        $iniciales .= strtoupper(substr($palabra, 0, 1));
                    }
                    
                    $variableConcatenada = $iniciales . date('Ymd', strtotime($fecha)) . 'MIT';
                @endphp

                <div class="row portada_top">
                    <div class="col-6">
                        <img class="img_logo"
                            src="https://www.mitviajes.com/wp-content/uploads/2019/03/Logo-Mit-Viajes.png"
                            alt="mit viajes">
                    </div>
                    <div class="col-6 tiulo">
                        <h1>Vaucher de servicio Mit Viajes Cusco</h1>
                    </div>
                </div>


            </div>
            <div class="col-12 mt-3">
                @if (session('success'))
                    <div class="alert alert-success text-center">
                        {{ session('success') }}
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-12 mt-3 info_div">
                <h2>{{ $reporte->tour }}</h2>
                <div class="info">
                    <span>+51 984 677 900</span>
                    <span>info@mitviajes.com</span>
                    <span>www.mitviajes.com</span>
                </div>
                <span>Para: {{ $reporte->nombre }} - COD: <b>{{ $variableConcatenada }} </b></span>
            </div>


            <div class="col-12 datos">
                <div class="row">
                    <div class="col-12">
                        <h3>Datos generales:</h3>
                    </div>
                    <div class="col-12">
                        <div class="row bordes">
                            <div class="col-4">
                                <p>Nome: <span>{{ $reporte->nombre }}</span></p>
                            </div>
                            <div class="col-4">
                                <p>Email: <span>{{ $reporte->email }}</span></p>
                            </div>
                            <div class="col-4">
                                <p>Whatsapp: <span>{{ $reporte->numero }}</span></p>
                            </div>
                            <div class="col-4">
                                <p>Começo do passeio:
                                    <span>{{ date('d \d\e F \d\e Y', strtotime($reporte->fechaInicio)) }}</span>
                                </p>
                            </div>
                            <div class="col-4">
                                <p>Briefing: <span>{{ date('d \d\e F \d\e Y', strtotime($reporte->briefing)) }}</span>
                                </p>
                            </div>
                            <div class="col-4">
                                <p>Tipo de moeda: <span>Dólares (USD)</span></p>
                            </div>
                            <div class="col-4">
                                <p>Total do pacote: <span>{{ $reporte->precio }}</span></p>
                            </div>
                            <div class="col-4">
                                <p>Adiantamento: <span>{{ $reporte->adelanto }}</span></p>
                            </div>
                            <div class="col-4">
                                <p>Restante: <span id="resto"></span></p>
                            </div>
                            <div class="col-4">
                                <p> Nº de passageiros: <span>{{ $reporte->numPaxs }}</span></p>
                            </div>
                            <div class="col-4">
                                <p>Começo do passeio:
                                    <span>{{ date('d \d\e F \d\e Y', strtotime($reporte->llegada)) }}</span>
                                </p>
                            </div>
                            <div class="col-4">
                                <p>Começo do passeio:
                                    <span>{{ date('d \d\e F \d\e Y', strtotime($reporte->salida)) }}</span>
                                </p>
                            </div>
                        </div>
                    </div>
                    @if ($reporte->pasajeros->isNotEmpty())
                        <div class="row mt-4">
                            <div class="col-12">
                                <h3>Detalhe de passageiros:</h3>
                            </div>
                            <div class="col-12">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col">Nome completo</th>
                                            <th scope="col">Passaporte</th>
                                            <th scope="col">Nacionalidade</th>
                                            <th scope="col">Alimentando</th>
                                            <th>Data de nascimiento</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($reporte->pasajeros as $pasajero) : ?>
                                        <tr>
                                            <td> {{ $pasajero->nombre }}</td>
                                            <td>{{ $pasajero->numeroPasaporte }}</td>
                                            <td>{{ $pasajero->nacionalidad }}</td>
                                            <td>
                                                @if ($pasajero->alimentacion == 'vegano')
                                                    Vegan@
                                                @elseif($pasajero->alimentacion == 'no_vegano')
                                                    No vegan@
                                                @endif
                                            </td>
                                            <td>{{ date('d-m-Y', strtotime($pasajero->fechaNacimiento)) }}</td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endif

                    @if ($reporte->trenes->isNotEmpty())
                        <div class="row mt-4">
                            <div class="col-12">
                                <h3>Detalhe de trenes:</h3>
                            </div>
                            <div class="col-12">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col">Ruta</th>
                                            <th scope="col">Compañía</th>
                                            <th scope="col">Servicio</th>
                                            <th scope="col">Fecha</th>
                                            <th scope="col">Hora</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($reporte->trenes as $tren)
                                            <tr>
                                                <td>{{ $tren->ruta }}</td>
                                                <td>{{ $tren->compania }}</td>
                                                <td>{{ $tren->servicio }}</td>
                                                <td>{{ $tren->fecha }}</td>
                                                <td>{{ $tren->hora }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endif
                    @if ($reporte->hoteles->isNotEmpty())
                        <div class="row mt-4 mb-2">
                            <div class="col-12">
                                <h3>Detalles de hoteles:</h3>
                            </div>
                            <div class="col-12">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col">Hotel</th>
                                            <th scope="col">Lugar</th>
                                            <th scope="col">Acomodación</th>
                                            <th scope="col">Fecha de ingreso</th>
                                            <th scope="col">Fecha de salida</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($reporte->hoteles as $hotel)
                                            <tr>
                                                <td>{{ $hotel->hotel }}</td>
                                                <td>{{ $hotel->lugar }}</td>
                                                <td>{{ $hotel->acomodacion }}</td>
                                                <td>{{ $hotel->fechaIngreso }}</td>
                                                <td>{{ $hotel->fechaSalida }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endif
                    <div class="row sinborde mt-4">
                        <div class="col-12">
                            <h3> Detalhes do roteiro:</h3>
                        </div>
                        <div class="col-12">
                            <h1>{{ $reporte->tour }}</h1>
                            {!! $reporte->detalles !!}
                        </div>
                    </div>
                </div>
            </div>
            <script>
                var precio = {
                    {
                        $reporte - > precio
                    }
                };
                var adelanto = {
                    {
                        $reporte - > adelanto
                    }
                };
                var resto = precio - adelanto;
                document.getElementById("resto").textContent = resto;
            </script>
            @if (Auth::check())
                <a class="pdf-button pdf-only" onclick="generatePDF()" title="Imprimir PDF">
                    <i class="fas fa-print"></i>
                </a>
                <form action="{{ route('enviar.correo', $reporte->id) }}" method="POST">
                    @csrf
                    <button class="btnCorreo" type="submit" title="Enviar correo"><i
                            class="fa fa-envelope"></i></button>
                </form>
            @endif
            <style>
                .whatsappbutton {
                    position: fixed;
                    bottom: 165px;
                    right: 20px;
                    z-index: 999;
                    background: #25D366;
                    color: #fff;
                    border-radius: 50%;
                    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
                    width: 50px;
                    height: 50px;
                    cursor: pointer;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    transition: 0.4s;
                }

                .whatsappbutton i {
                    font-size: 24px;
                }

                .whatsappbutton:hover {
                    background: #128C7E;
                }
            </style>
            @if (Auth::check() && $reporte->numero)
                <a href="https://api.whatsapp.com/send?phone={{ $reporte->numero }}&text=¡Hola!%20Aquí%20tienes%20mi%20boleta:%20{{ urlencode(url()->current()) }}"
                    target="_blank" class="whatsappbutton">
                    <i class="fab fa-whatsapp"></i>
                </a>
            @endif

            <script>
                function generatePDF() {
                    window.print();
                    document.title = originalTitle;
                    document.querySelector('button').style.display = 'block';
                    window.location.reload();
                }
            </script>

</body>

</html>
