<?php

namespace App\Http\Controllers;

use App\Models\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class loginController extends Controller
{
    private $logs;
    public function __construct()
    {
        $this->logs  = new Log();
    }
    public function  login(){
        try{

            // Verificar si existe el access_token en la sesión
            if (session()->has('access_token')) {
                return redirect()->route('intranet');
            }

            return view('auth.login');
        }catch (\Exception $e){
            $this->logs->insertarLog($e);
            return redirect()->route('login')->with('error', 'Ocurrió un error al intentar mostrar el contenido.');
        }
    }
    public function  cerrarSesion(){
        try{

            $response = Http::withToken(session('access_token'))->post(env('APP_URL_AUTH').'api/v1/auth/logout');

            if ($response->successful()) {
                session()->flush();  // Limpia la sesión
                return redirect()->route('login')->with('status', '¡Sesión cerrada con éxito!');
            } else {
                return redirect()->route('intranet')->with('error', 'Error al cerrar sesión.');
            }

        }catch (\Exception $e){
            $this->logs->insertarLog($e);
            return redirect()->route('login')->with('error', 'Ocurrió un error al intentar mostrar el contenido.');
        }
    }

}
