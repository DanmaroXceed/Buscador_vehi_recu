<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Vehiculo;
use App\Models\Foto;

class MainController extends Controller
{
    public function index(){
        $vehiculos = Vehiculo::select('id', 'marca', 'submarca', 'modelo', 'color', 'serie', 'placas', 'estado')
            ->where('estado', '=', '1')
            ->get();
        $fotos = Foto::select('id', 'vehiculo_id', 'url')->get();

        return view('principal',  compact('vehiculos','fotos'));
    }
}
