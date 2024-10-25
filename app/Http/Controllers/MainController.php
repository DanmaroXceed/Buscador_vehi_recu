<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MainController extends Controller
{
    public function index(){
        $vehiculos = [
            [
                'Marca' => 'Toyota',
                'Submarca' => 'Corolla',
                'Modelo' => '2020',
                'Serie' => 'JTDBURHE9LJ012345',
                'Ubicacion' => 'Avenida Insurgentes 123, Ciudad de México',
                'Fecha' => '2022-01-15',
            ],
            [
                'Marca' => 'Ford',
                'Submarca' => 'Fiesta',
                'Modelo' => '2019',
                'Serie' => '1FADP3F21JL123456',
                'Ubicacion' => 'Calle Reforma 456, Guadalajara',
                'Fecha' => '2021-06-30',
            ],
            [
                'Marca' => 'Chevrolet',
                'Submarca' => 'Spark',
                'Modelo' => '2018',
                'Serie' => 'KL1TJ6S67JC012345',
                'Ubicacion' => 'Calle Juárez 789, Monterrey',
                'Fecha' => '2020-12-05',
            ],
            [
                'Marca' => 'Nissan',
                'Submarca' => 'Versa',
                'Modelo' => '2021',
                'Serie' => '3N1CN7AP6HL123456',
                'Ubicacion' => 'Avenida Universidad 321, Puebla',
                'Fecha' => '2022-04-20',
            ],
            [
                'Marca' => 'Volkswagen',
                'Submarca' => 'Jetta',
                'Modelo' => '2020',
                'Serie' => '3VWN57BU7LM123456',
                'Ubicacion' => 'Calle 5 de Febrero 654, Mérida',
                'Fecha' => '2021-08-10',
            ],
            [
                'Marca' => 'Honda',
                'Submarca' => 'Civic',
                'Modelo' => '2017',
                'Serie' => '2HGFC2F55HH012345',
                'Ubicacion' => 'Calle 16 de Septiembre 543, León',
                'Fecha' => '2020-03-15',
            ],
            [
                'Marca' => 'Hyundai',
                'Submarca' => 'Elantra',
                'Modelo' => '2020',
                'Serie' => '5NPD84LF1LH012345',
                'Ubicacion' => 'Avenida Juárez 234, Tijuana',
                'Fecha' => '2022-02-12',
            ],
            [
                'Marca' => 'Mazda',
                'Submarca' => 'Mazda3',
                'Modelo' => '2019',
                'Serie' => 'JM1BN1L73K123456',
                'Ubicacion' => 'Calle Hidalgo 456, Cancún',
                'Fecha' => '2021-07-22',
            ],
            [
                'Marca' => 'Kia',
                'Submarca' => 'Rio',
                'Modelo' => '2021',
                'Serie' => 'KNAFK4A63M123456',
                'Ubicacion' => 'Calle Morelos 321, San Luis Potosí',
                'Fecha' => '2022-05-30',
            ],
            [
                'Marca' => 'Subaru',
                'Submarca' => 'Impreza',
                'Modelo' => '2018',
                'Serie' => 'JF1GJAA6JH123456',
                'Ubicacion' => 'Avenida 20 de Noviembre 876, Hermosillo',
                'Fecha' => '2020-09-05',
            ],
            [
                'Marca' => 'Fiat',
                'Submarca' => '500',
                'Modelo' => '2017',
                'Serie' => '3C3CFFBR4HT012345',
                'Ubicacion' => 'Calle 11 de Enero 234, Saltillo',
                'Fecha' => '2021-11-18',
            ],
            [
                'Marca' => 'Chrysler',
                'Submarca' => '300',
                'Modelo' => '2019',
                'Serie' => '2C3CCAGG9KH012345',
                'Ubicacion' => 'Avenida Revolución 345, Querétaro',
                'Fecha' => '2021-02-20',
            ],
            [
                'Marca' => 'Dodge',
                'Submarca' => 'Charger',
                'Modelo' => '2020',
                'Serie' => '2C3CDXHG3LH012345',
                'Ubicacion' => 'Calle 5 de Mayo 678, Chihuahua',
                'Fecha' => '2022-03-28',
            ],
            [
                'Marca' => 'Toyota',
                'Submarca' => 'Camry',
                'Modelo' => '2021',
                'Serie' => '4T1B11HK0LU012345',
                'Ubicacion' => 'Calle 3 de Octubre 789, Oaxaca',
                'Fecha' => '2022-06-18',
            ],
            [
                'Marca' => 'BMW',
                'Submarca' => 'X3',
                'Modelo' => '2018',
                'Serie' => '5UXTR9C55J0C12345',
                'Ubicacion' => 'Avenida del Taller 456, Aguascalientes',
                'Fecha' => '2020-04-10',
            ],
            [
                'Marca' => 'Mercedes-Benz',
                'Submarca' => 'C-Class',
                'Modelo' => '2019',
                'Serie' => 'WDDWF4JB5KA123456',
                'Ubicacion' => 'Calle 1 de Mayo 234, Durango',
                'Fecha' => '2021-12-01',
            ],
            [
                'Marca' => 'Lexus',
                'Submarca' => 'RX',
                'Modelo' => '2020',
                'Serie' => '2T2BZMCA8LC123456',
                'Ubicacion' => 'Calle San Juan 678, Ciudad Juárez',
                'Fecha' => '2022-08-30',
            ],
            [
                'Marca' => 'Porsche',
                'Submarca' => 'Cayenne',
                'Modelo' => '2018',
                'Serie' => 'WP1AA2A23JKA12345',
                'Ubicacion' => 'Avenida Libertad 543, Colima',
                'Fecha' => '2020-02-14',
            ],
            [
                'Marca' => 'Audi',
                'Submarca' => 'A4',
                'Modelo' => '2019',
                'Serie' => 'WAUBFBFL1K1001234',
                'Ubicacion' => 'Calle Carranza 789, Villahermosa',
                'Fecha' => '2021-10-29',
            ],
            [
                'Marca' => 'Volkswagen',
                'Submarca' => 'Tiguan',
                'Modelo' => '2020',
                'Serie' => 'WVGAV7AX8LW123456',
                'Ubicacion' => 'Avenida Chapultepec 345, Zacatecas',
                'Fecha' => '2022-07-15',
            ],
        ];
        

        return view('principal', ['vehiculos' => $vehiculos]);
    }
}
