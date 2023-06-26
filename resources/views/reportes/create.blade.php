@extends('layouts.admin')
@section('titulo', 'Crear Reporte de Pasajeros')
@section('contenido')
    <div class="row">


        <div class="col-12">
            <h2>Crear Reporte de Pasajeros</h2>
        </div>


        <div class="col-12">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>

        <div class="col-12">
            <form action="{{ route('reportes.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-sm-6 col-md-4 mt-3">
                        <label for="tour">Paquete turístico:</label>
                        <input type="text" name="tour" class="form-control form-control-sm" required
                            value="{{ old('tour') }}">
                        @if ($errors->has('tour'))
                            <span class="text-danger">{{ $errors->first('tour') }}</span>
                        @endif
                    </div>

                    <div class="col-sm-6 col-md-4 mt-3">
                        <label for="nombre">Nombre Pasajero:</label>
                        <input type="text" name="nombre" class="form-control form-control-sm" required
                            value="{{ old('nombre') }}">
                        @if ($errors->has('nombre'))
                            <span class="text-danger">{{ $errors->first('nombre') }}</span>
                        @endif
                    </div>

                    <div class="col-sm-6 col-md-4 mt-3">
                        <label for="email">Email:</label>
                        <input type="email" name="email" class="form-control form-control-sm" required
                            value="{{ old('email') }}">
                        @if ($errors->has('email'))
                            <span class="text-danger">{{ $errors->first('email') }}</span>
                        @endif
                    </div>

                    <div class="col-sm-6 col-md-4 mt-3">
                        <label for="numero">Whatsapp:</label>
                        <input type="text" name="numero" class="form-control form-control-sm" required
                            value="{{ old('numero') }}">
                        @if ($errors->has('numero'))
                            <span class="text-danger">{{ $errors->first('numero') }}</span>
                        @endif
                    </div>

                    <div class="col-sm-6 col-md-4 mt-3">
                        <label for="llegada">Fecha de llegada:</label>
                        <input type="date" name="llegada" class="form-control form-control-sm" required
                            value="{{ old('llegada') }}">
                        @if ($errors->has('llegada'))
                            <span class="text-danger">{{ $errors->first('llegada') }}</span>
                        @endif
                    </div>

                    <div class="col-sm-6 col-md-4 mt-3">
                        <label for="salida">Fecha de salida:</label>
                        <input type="date" name="salida" class="form-control form-control-sm" required
                            value="{{ old('salida') }}">
                        @if ($errors->has('salida'))
                            <span class="text-danger">{{ $errors->first('salida') }}</span>
                        @endif
                    </div>

                    <div class="col-sm-6 col-md-4 mt-3">
                        <label for="fechaInicio">Fecha Inicio de Tour:</label>
                        <input type="date" name="fechaInicio" class="form-control form-control-sm" required
                            value="{{ old('fechaInicio') }}">
                        @if ($errors->has('fechaInicio'))
                            <span class="text-danger">{{ $errors->first('fechaInicio') }}</span>
                        @endif
                    </div>

                    <div class="col-sm-6 col-md-4 mt-3">
                        <label for="briefing">Briefing:</label>
                        <input type="date" name="briefing" class="form-control form-control-sm" required
                            value="{{ old('briefing') }}">
                        @if ($errors->has('briefing'))
                            <span class="text-danger">{{ $errors->first('briefing') }}</span>
                        @endif
                    </div>

                    <div class="col-sm-6 col-md-4 mt-3">
                        <label for="numPaxs">N° Paxs:</label>
                        <input type="number" name="numPaxs" class="form-control form-control-sm"
                            placeholder="Escoger número entre 1 a 14" onchange="generarCamposPasajeros(this.value)"
                            value="{{ old('numPaxs') }}">
                        @if ($errors->has('numPaxs'))
                            <span class="text-danger">{{ $errors->first('numPaxs') }}</span>
                        @endif
                    </div>

                    <div class="col-sm-6 col-md-4 mt-3">
                        <label for="precio">Precio:</label>
                        <input type="number" name="precio" id="precio" class="form-control form-control-sm"
                            onchange="calcularRestante()" value="{{ old('precio') }}" required>
                        @if ($errors->has('precio'))
                            <span class="text-danger">{{ $errors->first('precio') }}</span>
                        @endif
                    </div>

                    <div class="col-sm-6 col-md-4 mt-3">
                        <label for="adelanto">Adelanto:</label>
                        <input type="number" name="adelanto" id="adelanto" class="form-control form-control-sm"
                            onchange="calcularRestante()" value="{{ old('adelanto') }}" required>
                        @if ($errors->has('adelanto'))
                            <span class="text-danger">{{ $errors->first('adelanto') }}</span>
                        @endif
                    </div>

                    <div class="col-sm-6 col-md-4 mt-3">
                        <label for="restante">Restante:</label>
                        <input type="number" name="restante" id="restante" class="form-control form-control-sm" readonly
                            value="{{ old('restante') }}">
                    </div>

                    <!------Pasajeros------------>
                    <div class="separadorReportes mt-5" style="width: 100%; border-top:1px solid grey">
                        <h3 class="mt-2">Pasajeros:</h3>
                    </div>
                    <div id="contenedorPasajeros" class="col-12 mt-3"></div>

                    <div class="separadorReportes mt-5" style="width: 100%; border-top:1px solid grey">
                        <h3 class="mt-2">Trenes:</h3>
                    </div>
                    <div class="col-lg-12 mt-3">
                        <div class="row">
                            <div class="col-3">
                                <h5>N° de trenes:</h5>
                            </div>
                            <div class="col-9">
                                <select name="trenes" class="form-control form-control-sm" id=""
                                    onchange="generarCamposTrenes(this.value)">
                                    <option value="" selected>0</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div id="contenedorTrenes" class="col-lg-12 mt-3">
                    </div>
                    <div class="separadorReportes mt-5" style="width: 100%; border-top:1px solid grey">
                        <h3 class="mt-2">Hoteles:</h3>
                    </div>
                    <div class="col-lg-12 mt-3">
                        <div class="row">
                            <div class="col-3">
                                N° de Hoteles:
                            </div>
                            <div class="col-9">
                                <select name="hoteles" class="form-control form-control-sm" id=""
                                    onchange="generarCamposHoteles(this.value)">
                                    <option value="" selected>0</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10">10</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div id="contenedorHoteles" class="col-lg-12 mt-3">
                    </div>

                    <div class="col-12 mt-3">
                        <label for="detalles">Detalles:</label>
                        <textarea name="detalles" class="ckeditor form-control form-control-sm" rows="5"
                            placeholder="Ingrese los detalles" required>{{ old('detalles') }}</textarea>
                        @if ($errors->has('detalles'))
                            <span class="text-danger">{{ $errors->first('detalles') }}</span>
                        @endif
                    </div>

                    <script>
                        function generarCamposPasajeros(numeroPasajeros) {
                            var contenedorPasajeros = document.getElementById('contenedorPasajeros');
                            var pasajerosActuales = contenedorPasajeros.querySelectorAll('.row');
                            var cantidadPasajerosActuales = pasajerosActuales.length;

                            if (numeroPasajeros < cantidadPasajerosActuales) {
                                // Eliminar campos de pasajeros adicionales
                                for (var i = cantidadPasajerosActuales; i > numeroPasajeros; i--) {
                                    contenedorPasajeros.removeChild(pasajerosActuales[i - 1]);
                                    contenedorPasajeros.removeChild(contenedorPasajeros.lastElementChild); // Eliminar el último <hr>
                                }
                            } else if (numeroPasajeros > cantidadPasajerosActuales) {
                                // Agregar campos de pasajeros adicionales
                                for (var i = cantidadPasajerosActuales + 1; i <= numeroPasajeros; i++) {
                                    var row = document.createElement('div');
                                    row.classList.add('row');

                                    var col1 = document.createElement('div');
                                    col1.classList.add('col-12', 'col-md-1', 'mt-3');
                                    row.appendChild(col1);

                                    var label1 = document.createElement('label');
                                    label1.setAttribute('for', 'nombre' + i);
                                    label1.innerText = 'Pasajero:';
                                    col1.appendChild(label1);

                                    var input1 = document.createElement('input');
                                    input1.setAttribute('type', 'text');
                                    input1.setAttribute('value', i);
                                    input1.classList.add('form-control');
                                    input1.setAttribute('readonly', 'readonly');
                                    col1.appendChild(input1);

                                    var col2 = document.createElement('div');
                                    col2.classList.add('col-12', 'col-md-3', 'mt-3');
                                    row.appendChild(col2);

                                    var label2 = document.createElement('label');
                                    label2.setAttribute('for', 'nombre' + i);
                                    label2.innerText = 'Nombre:';
                                    col2.appendChild(label2);

                                    var input2 = document.createElement('input');
                                    input2.setAttribute('type', 'text');
                                    input2.setAttribute('name', 'pasajeros[' + i + '][nombre]');
                                    input2.classList.add('form-control');
                                    input2.setAttribute('required', 'required');
                                    col2.appendChild(input2);

                                    var col3 = document.createElement('div');
                                    col3.classList.add('col-12', 'col-md-2', 'mt-3');
                                    row.appendChild(col3);

                                    var label3 = document.createElement('label');
                                    label3.setAttribute('for', 'nacionalidad' + i);
                                    label3.innerText = 'Nacionalidad:';
                                    col3.appendChild(label3);

                                    var input3 = document.createElement('input');
                                    input3.setAttribute('type', 'text');
                                    input3.setAttribute('name', 'pasajeros[' + i + '][nacionalidad]');
                                    input3.classList.add('form-control');
                                    input3.setAttribute('required', 'required');
                                    col3.appendChild(input3);

                                    var col4 = document.createElement('div');
                                    col4.classList.add('col-12', 'col-md-2', 'mt-3');
                                    row.appendChild(col4);

                                    var label4 = document.createElement('label');
                                    label4.setAttribute('for', 'pasaporte' + i);
                                    label4.innerText = 'N° de Pasaporte:';
                                    col4.appendChild(label4);

                                    var input4 = document.createElement('input');
                                    input4.setAttribute('type', 'text');
                                    input4.setAttribute('name', 'pasajeros[' + i + '][numeroPasaporte]');
                                    input4.classList.add('form-control');
                                    input4.setAttribute('required', 'required');
                                    col4.appendChild(input4);

                                    var col5 = document.createElement('div');
                                    col5.classList.add('col-12', 'col-md-2', 'mt-3');
                                    row.appendChild(col5);

                                    var label5 = document.createElement('label');
                                    label5.setAttribute('for', 'nacimiento' + i);
                                    label5.innerText = 'Fecha de nacimiento:';
                                    col5.appendChild(label5);

                                    var input5 = document.createElement('input');
                                    input5.setAttribute('type', 'date');
                                    input5.setAttribute('name', 'pasajeros[' + i + '][fechaNacimiento]');
                                    input5.classList.add('form-control');
                                    input5.setAttribute('required', 'required');
                                    col5.appendChild(input5);

                                    var col6 = document.createElement('div');
                                    col6.classList.add('col-12', 'col-md-2', 'mt-3');
                                    row.appendChild(col6);

                                    var label6 = document.createElement('label');
                                    label6.setAttribute('for', 'alimentacion' + i);
                                    label6.innerText = 'Alimentación:';
                                    col6.appendChild(label6);

                                    var select = document.createElement('select');
                                    select.setAttribute('name', 'pasajeros[' + i + '][alimentacion]');
                                    select.classList.add('form-control');
                                    select.setAttribute('required', 'required');
                                    col6.appendChild(select);

                                    var option1 = document.createElement('option');
                                    option1.setAttribute('value', 'vegano');
                                    option1.innerText = 'Vegano';
                                    select.appendChild(option1);

                                    var option2 = document.createElement('option');
                                    option2.setAttribute('value', 'no_vegano');
                                    option2.innerText = 'No Vegano';
                                    select.appendChild(option2);


                                    contenedorPasajeros.appendChild(row);

                                    var hr = document.createElement('hr');
                                    contenedorPasajeros.appendChild(hr);
                                }
                            }
                        }
                    </script>

                    <script>
                        function generarCamposTrenes(numeroTrenes) {
                            var contenedorTrenes = document.getElementById('contenedorTrenes');
                            var trenesActuales = contenedorTrenes.querySelectorAll('.row');
                            var cantidadTrenesActuales = trenesActuales.length;

                            if (numeroTrenes < cantidadTrenesActuales) {
                                // Eliminar campos de trenes adicionales
                                for (var i = cantidadTrenesActuales; i > numeroTrenes; i--) {
                                    contenedorTrenes.removeChild(trenesActuales[i - 1]);
                                    contenedorTrenes.removeChild(contenedorTrenes.lastElementChild); // Eliminar el último <hr>
                                }
                            } else if (numeroTrenes > cantidadTrenesActuales) {
                                // Agregar campos de trenes adicionales
                                for (var i = cantidadTrenesActuales + 1; i <= numeroTrenes; i++) {
                                    var row = document.createElement('div');
                                    row.classList.add('row');

                                    var col1 = document.createElement('div');
                                    col1.classList.add('col-1', 'mt-3');
                                    row.appendChild(col1);

                                    var label1 = document.createElement('label');
                                    label1.setAttribute('for', 'tren' + i);
                                    label1.innerText = 'Tren:';
                                    col1.appendChild(label1);

                                    var input1 = document.createElement('input');
                                    input1.setAttribute('type', 'text');
                                    input1.setAttribute('value', i);
                                    input1.classList.add('form-control', 'form-control-sm');
                                    input1.setAttribute('readonly', 'readonly');
                                    col1.appendChild(input1);

                                    var col2 = document.createElement('div');
                                    col2.classList.add('col-3', 'mt-3');
                                    row.appendChild(col2);

                                    var label2 = document.createElement('label');
                                    label2.setAttribute('for', 'ruta' + i);
                                    label2.innerText = 'Ruta:';
                                    col2.appendChild(label2);

                                    var input2 = document.createElement('input');
                                    input2.setAttribute('type', 'text');
                                    input2.setAttribute('name', 'trenes[' + (i - 1) + '][ruta]');
                                    input2.classList.add('form-control', 'form-control-sm');
                                    col2.appendChild(input2);

                                    var col3 = document.createElement('div');
                                    col3.classList.add('col-2', 'mt-3');
                                    row.appendChild(col3);

                                    var label3 = document.createElement('label');
                                    label3.setAttribute('for', 'compania' + i);
                                    label3.innerText = 'Compañía:';
                                    col3.appendChild(label3);

                                    var input3 = document.createElement('input');
                                    input3.setAttribute('type', 'text');
                                    input3.setAttribute('name', 'trenes[' + (i - 1) + '][compania]');
                                    input3.classList.add('form-control', 'form-control-sm');
                                    col3.appendChild(input3);

                                    var col4 = document.createElement('div');
                                    col4.classList.add('col-2', 'mt-3');
                                    row.appendChild(col4);

                                    var label4 = document.createElement('label');
                                    label4.setAttribute('for', 'servicio' + i);
                                    label4.innerText = 'Servicio:';
                                    col4.appendChild(label4);

                                    var input4 = document.createElement('input');
                                    input4.setAttribute('type', 'text');
                                    input4.setAttribute('name', 'trenes[' + (i - 1) + '][servicio]');
                                    input4.classList.add('form-control', 'form-control-sm');
                                    col4.appendChild(input4);

                                    var col5 = document.createElement('div');
                                    col5.classList.add('col-2', 'mt-3');
                                    row.appendChild(col5);

                                    var label5 = document.createElement('label');
                                    label5.setAttribute('for', 'fecha' + i);
                                    label5.innerText = 'Fecha:';
                                    col5.appendChild(label5);

                                    var input5 = document.createElement('input');
                                    input5.setAttribute('type', 'date');
                                    input5.setAttribute('name', 'trenes[' + (i - 1) + '][fecha]');
                                    input5.classList.add('form-control', 'form-control-sm');
                                    col5.appendChild(input5);

                                    var col6 = document.createElement('div');
                                    col6.classList.add('col-2', 'mt-3');
                                    row.appendChild(col6);

                                    var label6 = document.createElement('label');
                                    label6.setAttribute('for', 'hora' + i);
                                    label6.innerText = 'Hora:';
                                    col6.appendChild(label6);

                                    var input6 = document.createElement('input');
                                    input6.setAttribute('type', 'text');
                                    input6.setAttribute('name', 'trenes[' + (i - 1) + '][hora]');
                                    input6.classList.add('form-control', 'form-control-sm');
                                    col6.appendChild(input6);

                                    contenedorTrenes.appendChild(row);

                                    var hr = document.createElement('hr');
                                    contenedorTrenes.appendChild(hr);
                                }
                            }
                        }
                    </script>

                    <script>
                        function generarCamposHoteles(numeroHoteles) {
                            var contenedorHoteles = document.getElementById('contenedorHoteles');
                            var hotelesActuales = contenedorHoteles.querySelectorAll('.row');
                            var cantidadHotelesActuales = hotelesActuales.length;

                            if (numeroHoteles < cantidadHotelesActuales) {
                                // Eliminar campos de hoteles adicionales
                                for (var i = cantidadHotelesActuales; i > numeroHoteles; i--) {
                                    contenedorHoteles.removeChild(hotelesActuales[i - 1]);
                                    contenedorHoteles.removeChild(contenedorHoteles.lastElementChild); // Eliminar el último <hr>
                                }
                            } else if (numeroHoteles > cantidadHotelesActuales) {
                                // Agregar campos de hoteles adicionales
                                for (var i = cantidadHotelesActuales + 1; i <= numeroHoteles; i++) {
                                    var row = document.createElement('div');
                                    row.classList.add('row');

                                    var col1 = document.createElement('div');
                                    col1.classList.add('col-3', 'mt-3');
                                    row.appendChild(col1);

                                    var label1 = document.createElement('label');
                                    label1.setAttribute('for', 'hotel' + i);
                                    label1.innerText = 'Hotel:';
                                    col1.appendChild(label1);

                                    var input1 = document.createElement('input');
                                    input1.setAttribute('type', 'text');
                                    input1.setAttribute('name', 'hoteles[' + i + '][hotel]');
                                    input1.classList.add('form-control', 'form-control-sm');
                                    input1.setAttribute('required', 'required');
                                    col1.appendChild(input1);

                                    var col2 = document.createElement('div');
                                    col2.classList.add('col-3', 'mt-3');
                                    row.appendChild(col2);

                                    var label2 = document.createElement('label');
                                    label2.setAttribute('for', 'lugar' + i);
                                    label2.innerText = 'Lugar:';
                                    col2.appendChild(label2);

                                    var input2 = document.createElement('input');
                                    input2.setAttribute('type', 'text');
                                    input2.setAttribute('name', 'hoteles[' + i + '][lugar]');
                                    input2.classList.add('form-control', 'form-control-sm');
                                    input2.setAttribute('required', 'required');
                                    col2.appendChild(input2);

                                    // ... Añade el resto de los campos necesarios

                                    contenedorHoteles.appendChild(row);

                                    var hr = document.createElement('hr');
                                    contenedorHoteles.appendChild(hr);
                                }
                            }
                        }
                    </script>





                    <script>
                        function calcularRestante() {
                            var precio = parseFloat(document.getElementById('precio').value) || 0;
                            var adelanto = parseFloat(document.getElementById('adelanto').value) || 0;
                            var restante = precio - adelanto;
                            document.getElementById('restante').value = restante;
                        }
                    </script>

                    <button type="submit" class="btn btn-primary mt-3">Guardar</button>
                </div>
            </form>
        </div>
    </div>
@endsection
