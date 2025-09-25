<?php

namespace App\Http\Controllers;

use App\Models\Log;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    private $logs;
    public function __construct()
    {
        $this->logs  = new Log();
    }

    public function  intranet(){
        try{


            return view('admin.intranet');
        }catch (\Exception $e){
            $this->logs->insertarLog($e);
            return redirect()->route('intranet')->with('error', 'Ocurrió un error al intentar mostrar el contenido.');
        }
    }


}
