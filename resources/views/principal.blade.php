@extends('app')

@section('contenido')
    <style>
        .rectangulo {
            width: 100%;
            max-width: 1000px;
            height: 200px;
            background: linear-gradient(180deg, #001a33, #00284d);
            border-radius: 10px;
            /* Esquinas ligeramente redondeadas */
            margin: 0 auto;
            /* Centrar horizontalmente */
            display: flex;
            flex-direction: column;
            justify-content: center;
            /* Centrado vertical */
            align-items: center;
            /* Centrado horizontal */
            text-align: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .rectangulo p {
            margin: 0;
            /* Elimina los márgenes de los párrafos */
            color: white;
            /* Texto en color blanco */
        }

        .rectangulo p {
            font-size: 1.3rem;
            /* Tamaño de fuente más pequeño para el primer párrafo */
        }

        .rectangulo h1 {
            font-size: 2.8rem;
            /* Tamaño de fuente más grande para el segundo párrafo */
        }

        @media (max-width: 768px) {
            .rectangulo {
                height: 200px;
                /* Ajuste de altura para pantallas más pequeñas */
            }

            .rectangulo p {
                font-size: 0.9rem;
                /* Ajuste de fuente en pantallas medianas */
            }

            .rectangulo h1 {
                font-size: 2rem;
                /* Ajuste de fuente en pantallas medianas */
            }
        }

        @media (max-width: 480px) {
            .rectangulo {
                height: 150px;
                /* Ajuste adicional para pantallas muy pequeñas */
            }

            .rectangulo p {
                font-size: 0.8rem;
                /* Ajuste de fuente en pantallas pequeñas */
            }

            .rectangulo h1 {
                font-size: 1rem;
                /* Ajuste de fuente en pantallas pequeñas */
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
                    @foreach ($vehiculos as $v)
                        <tr>
                            <td>{{ $v->marca }}</td>
                            <td>{{ $v->submarca }}</td>
                            <td>{{ $v->modelo }}</td>
                            <td>{{ $v->color }}</td>
                            <td>{{ $v->serie }}</td>
                            <td>{{ $v->placas }}</td>
                            <td>
                                <!-- Carrusel de Fotos -->
                                <div id="carouselFotos{{ $v->id }}" class="carousel slide" data-bs-ride="carousel"
                                    style="width: 150px; height: 100px; margin: 0 auto; display: block;">
                                    <div class="carousel-inner">
                                        @php $primera = true; @endphp
                                        @foreach ($fotos as $f)
                                            @if ($f->vehiculo_id == $v->id)
                                                <div class="carousel-item {{ $primera ? 'active' : '' }}">
                                                    <img src="{{ asset("Vehiculos/{$f->vehiculo_id}/{$f->url}") }}"
                                                        class="d-block w-100"
                                                        style="object-fit: cover; width: 150px; height: 100px;"
                                                        alt="Foto de Vehículo">
                                                </div>
                                                @php $primera = false; @endphp
                                            @endif
                                        @endforeach
                                    </div>

                                    <!-- Controles del Carrusel -->
                                    <button class="carousel-control-prev" type="button"
                                        data-bs-target="#carouselFotos{{ $v->id }}" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Previous</span>
                                    </button>
                                    <button class="carousel-control-next" type="button"
                                        data-bs-target="#carouselFotos{{ $v->id }}" data-bs-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Next</span>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <script>
            new DataTable('#vehirecu', {
                scrollY: '100%',
                columns: [{
                        title: 'Marca'
                    },
                    {
                        title: 'Submarca'
                    },
                    {
                        title: 'Modelo'
                    },
                    {
                        title: 'Color'
                    },
                    {
                        title: 'Serie'
                    },
                    {
                        title: 'Placas'
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
