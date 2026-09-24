<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Libro de Reclamaciones Virtual</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light py-4">

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card shadow-sm border-0">
                <div class="card-body p-4 p-md-5">

                    <!-- Cabecera Institucional -->
                    <div class="text-center mb-4">
                        <h2 class="fw-bold text-primary">LIBRO DE RECLAMACIONES VIRTUAL</h2>
                        <p class="mb-0 text-muted"><strong>{{ 'ORIGEN Restaurante' }}</strong> | RUC: 10458404068</p>
                        <small class="text-muted">Calle Plateros 358 - A, Cusco - Perú  </small>
                    </div>

                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {!! session('success') !!}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('libro-reclamaciones.store') }}" method="POST">
                        @csrf

                        <!-- SECCIÓN 1 -->
                        <div class="bg-primary text-white p-2 rounded mb-3 font-weight-bold fw-semibold">
                            1. Identificación del Consumidor Reclamante
                        </div>

                        <div class="row g-3 mb-3">
                            <div class="col-md-4">
                                <label for="tipo_doc" class="form-label fw-bold">Tipo Documento *</label>
                                <select class="form-select" id="tipo_doc" name="tipo_doc" required>
                                    <option value="DNI" {{ old('tipo_doc') == 'DNI' ? 'selected' : '' }}>DNI</option>
                                    <option value="CE" {{ old('tipo_doc') == 'CE' ? 'selected' : '' }}>Carnet Extranjería</option>
                                    <option value="Pasaporte" {{ old('tipo_doc') == 'Pasaporte' ? 'selected' : '' }}>Pasaporte</option>
                                    <option value="RUC" {{ old('tipo_doc') == 'RUC' ? 'selected' : '' }}>RUC</option>
                                </select>
                            </div>
                            <div class="col-md-8">
                                <label for="num_doc" class="form-label fw-bold">N° Documento *</label>
                                <input type="text" class="form-control" id="num_doc" name="num_doc" value="{{ old('num_doc') }}" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="nombre_completo" class="form-label fw-bold">Nombres y Apellidos completosis / Razón Social *</label>
                            <input type="text" class="form-control" id="nombre_completo" name="nombre_completo" value="{{ old('nombre_completo') }}" required>
                        </div>

                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label for="email" class="form-label fw-bold">Correo Electrónico *</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
                            </div>
                            <div class="col-md-6">
                                <label for="telefono" class="form-label fw-bold">Teléfono / Celular *</label>
                                <input type="tel" class="form-control" id="telefono" name="telefono" value="{{ old('telefono') }}" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="direccion" class="form-label fw-bold">Domicilio *</label>
                            <input type="text" class="form-control" id="direccion" name="direccion" value="{{ old('direccion') }}" required>
                        </div>

                        <div class="mb-3">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="es_menor_edad" name="es_menor_edad" value="1" {{ old('es_menor_edad') ? 'checked' : '' }} onchange="toggleApoderado(this.checked)">
                                <label class="form-check-label fw-bold" for="es_menor_edad">¿Es menor de edad?</label>
                            </div>
                        </div>

                        <div class="mb-3" id="wrapper_apoderado" style="display: {{ old('es_menor_edad') ? 'block' : 'none' }};">
                            <label for="nombre_apoderado" class="form-label fw-bold">Nombre del Padre, Madre o Apoderado</label>
                            <input type="text" class="form-control" id="nombre_apoderado" name="nombre_apoderado" value="{{ old('nombre_apoderado') }}">
                        </div>

                        <!-- SECCIÓN 2 -->
                        <div class="bg-primary text-white p-2 rounded mb-3 font-weight-bold fw-semibold">
                            2. Identificación del Bien Contratado
                        </div>

                        <div class="row g-3 mb-3">
                            <div class="col-md-4">
                                <label class="form-label fw-bold">Tipo de Bien *</label>
                                <div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="tipo_bien" id="bien_prod" value="Producto" {{ old('tipo_bien', 'Producto') == 'Producto' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="bien_prod">Producto</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="tipo_bien" id="bien_serv" value="Servicio" {{ old('tipo_bien') == 'Servicio' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="bien_serv">Servicio</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <label for="monto_reclamado" class="form-label fw-bold">Monto Reclamado (S/) *</label>
                                <input type="number" step="0.01" class="form-control" id="monto_reclamado" name="monto_reclamado" value="{{ old('monto_reclamado') }}" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="descripcion_bien" class="form-label fw-bold">Descripción del Bien/Servicio *</label>
                            <input type="text" class="form-control" id="descripcion_bien" name="descripcion_bien" placeholder="Ej. Almuerzo Ejecutivo, Consumo del 15/05/2026" value="{{ old('descripcion_bien') }}" required>
                        </div>

                        <!-- SECCIÓN 3 -->
                        <div class="bg-primary text-white p-2 rounded mb-3 font-weight-bold fw-semibold">
                            3. Detalle de la Reclamación y Pedido
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Tipo de Reclamación *</label>
                            <div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="tipo_reclamo" id="rec_reclamo" value="Reclamo" {{ old('tipo_reclamo', 'Reclamo') == 'Reclamo' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="rec_reclamo">
                                        <strong>Reclamo:</strong> Disconformidad relacionada con los productos o servicios.
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="tipo_reclamo" id="rec_queja" value="Queja" {{ old('tipo_reclamo') == 'Queja' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="rec_queja">
                                        <strong>Queja:</strong> Disconformidad no relacionada directamente a los productos o servicios; o mala atención al público.
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="detalle_reclamo" class="form-label fw-bold">Detalle del Reclamo o Queja *</label>
                            <textarea class="form-control" id="detalle_reclamo" name="detalle_reclamo" rows="4" required>{{ old('detalle_reclamo') }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label for="pedido_solicitud" class="form-label fw-bold">Pedido / Solicitud Concreta *</label>
                            <textarea class="form-control" id="pedido_solicitud" name="pedido_solicitud" rows="3" required placeholder="Indique de forma específica qué solución espera">{{ old('pedido_solicitud') }}</textarea>
                        </div>

                        <div class="form-check mb-4">
                            <input class="form-check-input" type="checkbox" id="terminos" name="terminos" value="1" required>
                            <label class="form-check-label small" for="terminos">
                                Declaro ser el titular del servicio y que los datos consignados en la presente hoja de reclamación son verdaderos.
                            </label>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg">Enviar Hoja de Reclamación</button>
                        </div>

                        <div class="alert alert-secondary mt-4 mb-0 small">
                            <strong>Nota Legal:</strong> La formulación del reclamo no impide acudir a otras vías de solución de controversias ni es requisito previo para interponer una denuncia ante el INDECOPI. El proveedor deberá dar respuesta al reclamo en un plazo no mayor a quince (15) días hábiles.
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function toggleApoderado(checked) {
        document.getElementById('wrapper_apoderado').style.display = checked ? 'block' : 'none';
    }
</script>
</body>
</html>