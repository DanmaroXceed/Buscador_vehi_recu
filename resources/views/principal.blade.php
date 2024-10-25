@extends('app')

@section('contenido')
<style>
    .rectangulo {
        width: 100%;
        max-width: 1000px;
        height: 300px;
        background: linear-gradient(180deg, #001a33, #00284d);
        border-radius: 10px; /* Esquinas ligeramente redondeadas */
        margin: 0 auto; /* Centrar horizontalmente */
        display: flex;
        flex-direction: column;
        justify-content: center; /* Centrado vertical */
        align-items: center;     /* Centrado horizontal */
        text-align: center;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    .rectangulo p {
        margin: 0; /* Elimina los márgenes de los párrafos */
        color: white; /* Texto en color blanco */
    }

    .rectangulo p {
        font-size: 1rem; /* Tamaño de fuente más pequeño para el primer párrafo */
    }

    .rectangulo h1 {
        font-size: 3rem; /* Tamaño de fuente más grande para el segundo párrafo */
    }

    @media (max-width: 768px) {
        .rectangulo {
            height: 200px; /* Ajuste de altura para pantallas más pequeñas */
        }
        
        .rectangulo p {
            font-size: 0.9rem; /* Ajuste de fuente en pantallas medianas */
        }

        .rectangulo h1 {
            font-size: 2rem; /* Ajuste de fuente en pantallas medianas */
        }
    }

    @media (max-width: 480px) {
        .rectangulo {
            height: 150px; /* Ajuste adicional para pantallas muy pequeñas */
        }

        .rectangulo p {
            font-size: 0.8rem; /* Ajuste de fuente en pantallas pequeñas */
        }

        .rectangulo h1 {
            font-size: 1rem; /* Ajuste de fuente en pantallas pequeñas */
        }
    }
</style>

<div class="rectangulo text-center text-white">
    <p>CONSULTA DE</p>
    <br>
    <h1>VEHÍCULOS RECUPERADOS</h1>
</div>

<div>
    <div>
        <table id="vehirecu" class="table table-striped table-bordered">
            <tbody>
                @for ($i = 0; $i < count($vehiculos); $i++)
                    <tr>
                        <td>{{ $vehiculos[$i]['Marca'] }}</td>
                        <td>{{ $vehiculos[$i]['Submarca'] }}</td>
                        <td>{{ $vehiculos[$i]['Modelo'] }}</td>
                        <td>{{ $vehiculos[$i]['Serie'] }}</td>
                        <td>{{ $vehiculos[$i]['Ubicacion'] }}</td>
                        <td>{{ $vehiculos[$i]['Fecha'] }}</td>
                        <td>
                            <img src="{{ asset('Vehiculos/'. $i+1) .'.jpg' }}" width="100px" height="80px">
                        </td>
                    </tr>
                @endfor
            </tbody>
        </table>
    </div>

    <script>
        new DataTable('#vehirecu', {
            scrollY: '100%',
            columns: [
                {
                    title: 'Marca'
                },
                {
                    title: 'Submarca'
                },
                {
                    title: 'Modelo'
                },
                {
                    title: 'Serie'
                },
                {
                    title: 'Ubicacion'
                },
                {
                    title: 'Fecha'
                },
                {
                    title: 'Fotografia'
                },
            ],
            language: {
                "decimal": "",
                "emptyTable": "No hay información",
                "info": "Mostrando <strong>_START_</strong> a <strong>_END_</strong> de <strong>_TOTAL_</strong> Entradas",
                "infoEmpty": "Mostrando <strong>0</strong> a <strong>0</strong> de <strong>0</strong> Entradas",
                "infoFiltered": "(Filtrado de _MAX_ total entradas)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ Entradas",
                "loadingRecords": "Cargando...",
                "processing": "Procesando...",
                "search": "Buscar:",
                "zeroRecords": "Sin resultados encontrados",
            },
            order: []
        });
    </script>
</div>
@endsection