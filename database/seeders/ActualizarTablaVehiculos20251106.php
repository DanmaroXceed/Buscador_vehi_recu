<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Vehiculo;
use App\Models\Foto;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class ActualizarTablaVehiculos20251106 extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Abrir CSV y preparar lectura
        $csvPath   = base_path("catalogos/vehiculos_actualizacion.csv");
        $csvFile   = fopen($csvPath, 'r');
        $firstline = true;

        // 2. Procesar cada registro del CSV
        while (($data = fgetcsv($csvFile, 2000, ",")) !== FALSE) {
            // Saltar cabecera
            if ($firstline) {
                $firstline = false;
                continue;
            }

            try {
                // 3. Iniciar transacción para rollback en caso de error
                DB::transaction(function () use ($data) {
                    try {
                        $fechaParte       = !empty($data[1])
                            ? Carbon::createFromFormat('d/m/Y', $data[1])->toDateString()
                            : null;
                    } catch (\Exception $e) {
                        // Si falla el parseo, lo dejas en null y logueas
                        Log::warning("Formato de FECHA PARTE inválido en registro {$data[0]}: " . $e->getMessage());
                        $fechaParte   = $fechaParte   ?? null;
                    }
                    try {
                        $fechaIngreso     = !empty($data[2])
                            ? Carbon::createFromFormat('d/m/Y', $data[2])->toDateString()
                            : null;
                    } catch (\Exception $e) {
                        // Si falla el parseo, lo dejas en null y logueas
                        Log::warning("Formato de FECHA INGRESO inválido en registro {$data[0]}: " . $e->getMessage());
                        $fechaIngreso = $fechaIngreso ?? null;
                    }
                    try {
                        $fechaRobo        = !empty($data[14])
                            ? Carbon::createFromFormat('d/m/Y', $data[14])->toDateString()
                            : null;
                    } catch (\Exception $e) {
                        // Si falla el parseo, lo dejas en null y logueas
                        Log::warning("Formato de FECHA ROBO inválido en registro {$data[0]}: " . $e->getMessage());
                        $fechaRobo    = $fechaRobo    ?? null;
                    }
                    // 4. Consulta a la base de datos externa para obtener area y elemento_asegura
                    $vehiculoExt = DB::connection('externa')
                        ->table('record as r')
                        ->join('vehicles as v', 'r.id', '=', 'v.record_id')
                        ->join('agency as a',   'r.id_agency', '=', 'a.id')
                        ->join('municipality as m', 'a.id_municipality', '=', 'm.id')
                        ->join('districts as d', 'm.district_id', '=', 'd.id')
                        ->whereNull('r.deleted_at')
                        ->where('v.serial_number', $data[4])
                        ->select([
                            'a.agency as area',
                            'v.recovery_person as elemento_asegura',
                        ])
                        ->first();

                    // 5. Crear registro Vehiculo usando datos CSV + externos
                    $vehiculo = Vehiculo::create([
                        'fecha_ingreso'        => $fechaIngreso,                        // [2] FECHA RECUPERACION
                        'fecha_liberacion'     => null,                                 // siempre null
                        'corporacion_asegura'  => $data[17],                            // [17] AUTORIDAD QUE RECUPERÓ
                        'elemento_asegura'     => $vehiculoExt->elemento_asegura ?? 'Sin dato',
                        'grua'                 => 'Sin dato',
                        'serie'                => $data[4],                             // [4] SERIE
                        'placas'               => $data[5],                             // [5] PLACAS
                        'marca'                => $data[7],                             // [7] MARCA
                        'submarca'             => $data[8],                             // [8] LÍNEA
                        'modelo'               => $data[9],                             // [9] MODELO
                        'color'                => $data[10],                            // [10] COLOR
                        'mp'                   => 'Sin dato',
                        'cui'                  => $data[18],                            // [18] CUI
                        'observaciones'        => $data[3],                             // [3] DESCRIPCIÓN
                        'estado'               => $data[24] === '' ? 1 : 0,             // [24] LIBERADO
                        'area'                 => $vehiculoExt->area ?? 'Sin dato',
                        'fecha_parte'          => $fechaParte,                          // [1] FECHA DEL PARTE
                        'tipo_v'               => $data[6],                             // [6] TIPO
                        'origen'               => $data[11],                            // [11] ORIGEN
                        'municipio'            => $data[12],                            // [12] MUNICIPIO
                        'calle'                => $data[13],                            // [13] LUGAR DE RECUPERACIÓN
                        'fecha_robo'           => $fechaRobo,                           // [14] FECHA DE ROBO
                        'rec_mismo_dia'        => $data[15] === 'Si' ? 1 : 0,           // [15] ternario
                        'alt_rem'              => $data[16] === 'Si' ? 1 : 0,           // [16] ternario
                    ]);

                    // 6. Registrar fotos y mover archivos
                    $baseActPath = public_path('fotos');
                    $newDir      = public_path("Vehiculos/{$vehiculo->id}");

                    // Crear carpeta si no existe
                    if (!File::exists($newDir)) {
                        File::makeDirectory($newDir, 0755, true);
                    }

                    // Recorrer campos [19]–[23] para crear fotos
                    for ($i = 19; $i <= 23; $i++) {
                        if (!empty($data[$i])) {
                            // Insertar registro en tabla fotos
                            Foto::create([
                                'vehiculo_id' => $vehiculo->id,
                                'url'         => $data[$i],
                            ]);

                            // Mover archivo físico si existe
                            $src = "{$baseActPath}/{$data[$i]}";
                            $dst = "{$newDir}/{$data[$i]}";
                            if (File::exists($src)) {
                                File::copy($src, $dst);
                            } else {
                                // Registrar en log que no existía
                                Log::warning("Imagen no encontrada para Vehículo {$vehiculo->id}: {$src}");
                            }
                        }
                    }
                });
            } catch (\Exception $e) {
                // 7. Captura errores, hace rollback y continúa con siguiente fila
                Log::error("Error procesando registro {$data[0]}: " . $e->getMessage());
                continue;
            }
        }

        // 8. Cerrar recurso
        fclose($csvFile);
    }
}
