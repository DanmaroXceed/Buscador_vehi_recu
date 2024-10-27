<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Vehiculo;

class VehiculosSeeder extends Seeder
{
    public function run(): void
    {
        $csvFile = fopen(base_path("catalogos/vehiculos.csv"), "r");

        $firstline = true;

        while (($data = fgetcsv($csvFile, 2000, ",")) !== FALSE) {

            if (!$firstline) {

                Vehiculo::create([
                    "fecha_ingreso" => $data['0'],
                    "fecha_liberacion" => $data['1'] ?: null,
                    "corporacion_asegura" => $data['2'],
                    "elemento_asegura" => $data['3'],
                    "grua" => $data['4'],
                    "serie" => $data['5'],
                    "placas" => $data['6'],
                    "marca" => $data['7'],
                    "submarca" => $data['8'],
                    "modelo" => $data['9'],
                    "color" => $data['10'],
                    "mp" => $data['11'],
                    "cui" => $data['12'],
                    "observaciones" => $data['13'],
                    "estado" => $data['14'],
                ]);    
            }
            $firstline = false;
        }
        fclose($csvFile);
    }
}
