<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Foto;

class FotosSeeder extends Seeder
{
    public function run(): void
    {
        $csvFile = fopen(base_path("catalogos/fotos.csv"), "r");

        $firstline = true;

        while (($data = fgetcsv($csvFile, 2000, ",")) !== FALSE) {

            if (!$firstline) {

                Foto::create([
                    "vehiculo_id" => $data['0'],
                    "url" => $data['1']
                ]);    
            }
            $firstline = false;
        }
        fclose($csvFile);
    }
}
