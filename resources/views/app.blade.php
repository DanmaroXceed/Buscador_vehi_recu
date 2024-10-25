<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Busqueda de Vehiculos Recuperados</title>

    <link rel="shortcut icon" type="image/png" href="{{ asset('/logoweb-1.png') }}">
    <link rel="shortcut icon" sizes="192x192" href="{{ asset('/logoweb-1.png') }}">

    <!-- Vincula la hoja de estilos CSS de Bootstrap 5.2.3 para dar estilos y diseño responsivo -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <!-- Incluye el archivo JavaScript de Bootstrap 5.2.3 con todas las dependencias necesarias en un solo bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>

    <!-- Carga el archivo JavaScript de Bootstrap 5.3.0 con todas las dependencias necesarias (incluyendo Popper.js) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

    <!-- Vincula la hoja de estilos CSS de Bootstrap 5.3.0 desde una CDN alternativa -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">

    <!-- Carga la librería jQuery versión 3.7.1, que es utilizada por muchas bibliotecas de JavaScript como DataTables -->
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>

    <!-- Carga el archivo JavaScript de DataTables versión 2.0.5, utilizado para agregar funcionalidad a tablas de datos -->
    <script src="https://cdn.datatables.net/2.0.5/js/dataTables.js"></script>

    <!-- Carga el archivo JavaScript específico de DataTables para integrarse con Bootstrap 5 -->
    <script src="https://cdn.datatables.net/2.0.5/js/dataTables.bootstrap5.js"></script>

    <!-- Vincula la hoja de estilos CSS específica de DataTables para integrarse con Bootstrap 5 -->
    <link href="https://cdn.datatables.net/2.0.5/css/dataTables.bootstrap5.css" rel="stylesheet">

    <!-- Vincula los íconos de Bootstrap Icons versión 1.11.3 para utilizar en el diseño de la página -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    {{-- Leaflet CSS - Mapa --}}
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>

    {{-- Leaflet JS --}}
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

    {{-- @livewireStyles --}}

    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            min-height: 100vh; /* Asegura que el cuerpo ocupe al menos toda la altura de la ventana */
        }
        /* Estilos personalizados para el navbar */
        .navbar-brand {
            flex-direction: column; /* Permitir que el logo y el título se apilen */
            align-items: center;    /* Centrar contenido en el eje horizontal */
        }

        .navbar-brand img {
            max-height: 50px; /* Ajustar el tamaño del logo */
        }

        .navbar-brand h1 {
            margin: 0; /* Eliminar margen del h1 */
            font-size: 1.25rem; /* Tamaño de texto responsivo */
            text-align: center; /* Centrar el texto */
        }

        /* Estilos para el botón en mobile */
        .navbar .btn {
            font-size: 0.8rem; /* Hacer el botón más pequeño en mobile */
            margin-top: 10px; /* Espaciado superior para separar del texto */
            margin-bottom: 10px; /* Espaciado inferior para separar del texto */
        }

        /* Footer que permanece en el fondo */
        .footer {
            background: white;
            color: lightgray;
            display: flex;
            align-items: center;
            justify-content: center; /* Centra todo el contenido del footer */
            position: fixed; /* Mantiene el footer en la parte inferior */
            bottom: 0; /* Alineado al fondo */
            left: 0;
            right: 0;
            padding: 10px;
            z-index: 10;
        }

        /* Estilo del contenedor principal */
        .ubicacion {
            background-color: #3a3a3a; /* Gris oscuro */
            width: 100vw;              /* Ocupa el 100% del ancho de la pantalla */
            height: auto;             /* Altura automática */
            display: flex;             /* Flex para dividir el espacio horizontalmente */
            flex-direction: row;       /* Coloca las secciones en fila (izquierda y derecha) */
            overflow: hidden;          /* Oculta el desbordamiento de las secciones */
            margin-bottom: 50px;      /* Espacio para evitar que el contenido se superponga al footer */
        }

        /* Estilo de cada sección */
        .sec-ubi {
            flex: 1;                   /* Permite que cada sección ocupe el mismo espacio */
            padding: 20px;            /* Espacio interno de cada sección */
            color: white;             /* Color del texto en blanco */
            margin-left: 5%;
            margin-right: 5%;
        }

        #map { 
            height: 100%; 
            z-index: 9;
        }
        
        /* Ajuste responsivo para pantallas medianas */
        @media (max-width: 1200px) {
            .footer {
                font-size: 50%; /* Ajusta este porcentaje según el tamaño deseado */
            }
        }

        /* Ajuste responsivo para pantallas medianas a pequeñas */
        @media (min-width: 768px) {
            .navbar-brand {
                flex-direction: row; /* Cambiar a fila en pantallas más grandes */
            }
            .navbar .btn {
                margin-left: auto; /* Alinear el botón a la derecha */
                margin-top: 0; /* Eliminar el margen superior en pantallas grandes */
            }
        }
        
        /* Ajuste responsivo para pantallas pequeñas */
        @media (max-width: 600px) {
            .footer {
                font-size: 40%;
            }
            .ubicacion {
                flex-direction: column; /* Cambia a orientación vertical en pantallas pequeñas */
                margin-bottom: 60px;    /* Aumentar el margen inferior para asegurarse de que el contenido no esté oculto */
            }
            .sec-ubi {
                padding: 15px;          /* Ajuste del padding en pantallas pequeñas */
            }
            #map { height: 300px; }
        }
    </style>

</head>
<body style="background: #e9e9e9">
    <nav class="navbar bg-body-tertiary" style="box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);">
        <div class="container-fluid px-4 px-md-5">
            <a class="navbar-brand d-flex align-items-center">
                <img src="{{ asset('/logoweb-navbar.png') }}" alt="Logo" class="me-2">
                <h1 class="h4 mb-0 p-2">Busqueda de Cédulas de Identificación</h1>
            </a>
            <!-- Alinear el botón a la derecha en pantallas más grandes -->
            <div class="d-none d-md-block"> <!-- Ocultar en móviles y mostrar en desktop -->
                <a href="https://www.fiscaliazacatecas.gob.mx/" class="btn btn-outline-primary">Página Principal FGJEZ</a>
            </div>

            <!-- Mostrar el botón centrado solo en móviles -->
            <div class="d-md-none w-100 text-center mt-2">
                <a href="https://www.fiscaliazacatecas.gob.mx/" class="btn btn-outline-primary">Página Principal FGJEZ</a>
            </div>
        </div>
    </nav>   

    <div class="contenido m-4" style="margin-bottom:100px">
        @yield('contenido')
    </div>

    <div class="ubicacion">
        <div class="sec-ubi">
            Encuéntranos 
            <p>
                <br>
                <strong>Dirección</strong> <br>
                Avenida Circuito Zacatecas No. 401 Col. Ciudad Gobierno, 98160 Zacatecas, Zac. <br><br>

                <strong>Teléfono</strong> <br>
                (492) 925 60 50<br><br>

                <strong>Horario</strong> <br>
                Lunes a viernes de 9:00 AM a 4:00 PM<br><br>

                <i>Atención 24 horas, los 365 días del año en el edificio de la Dirección General de la Policía de Investigación</i><br><br>

                <a href="https://www.fiscaliazacatecas.gob.mx/wp-content/uploads/2022/01/API_SIMPLIFICADO_17dic.pdf">Aviso de Privacidad</a> || 
                <a href="https://www.fiscaliazacatecas.gob.mx/wp-content/uploads/2024/01/FGJEZ-Circular_01-2024.pdf">Días Inhábiles</a>
            </p>
        </div>
        <div class="sec-ubi">
            <div id="map"></div>
        </div>
    </div>

    <footer class="footer">
        <div class="footer-center text-center">
            © Copyright 2019 - 2024 | Fiscalía General de Justicia del Estado de Zacatecas | Todos los derechos reservados
        </div>
    </footer>
</body>

<script>
    // Instancia del mapa
    var map = L.map('map').setView([22.780494, -102.618168], 16);

    // Agregar capas al mapa
    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19
    }).addTo(map);

    // Agregar marcador al mapa
    var marker = L.marker([22.779129, -102.618104]).addTo(map);

    // Popup en marcador
    marker.bindPopup("<b>Fiscalia General de Justicia del Estado de Zacatecas</b><br>Avenida Circuito Zacatecas No. 401 Col. <br>Ciudad Gobierno, 98160 <br>Zacatecas, Zac.").openPopup();

    // function onMapClick(e) {
    //     alert("You clicked the map at " + e.latlng);
    // }

    // map.on('click', onMapClick);
</script>
</html>