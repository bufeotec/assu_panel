<?php

namespace App\Livewire\Auth;

use App\Models\Log;
use Livewire\Component;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Http;
class Login extends Component
{
    private $logs;
    /*--------------------------------------------*/
    public $username;
    public $password;
    public $remember = false;
    /*--------------------------------------------*/
    public function __construct()
    {
        $this->logs = new Log();
    }

    public function render()
    {
        return view('livewire.auth.login');
    }

    public function iniciarSesion(){
        try {

            $this->validate([
                'username' => [
                    'required',
                    'string',
                    'max:50',
                ],
                'password' => [
                    'required',
                    'string',
                    'min:6',
                    'max:100',
                ],
            ], [
                'username.required' => 'El nombre de usuario es obligatorio.',
                'username.string'   => 'El nombre de usuario debe ser texto válido.',
                'username.max'      => 'El nombre de usuario no debe exceder :max caracteres.',

                'password.required' => 'La contraseña es obligatoria.',
                'password.string'   => 'La contraseña debe ser texto válido.',
                'password.min'      => 'La contraseña debe tener al menos :min caracteres.',
                'password.max'      => 'La contraseña no debe exceder :max caracteres.',
            ]);

            $response = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->post(env('APP_URL_AUTH').'api/v1/auth/login', [
                'username' => $this->username,
                'password' => $this->password,
            ]);


            if ($response->successful()) {
                // Obtener los tokens de la respuesta
                $tokens = $response->json();

                // Almacenar el access_token y refresh_token
                session([
                    'access_token'  => $tokens['data']['access_token'],
                    'refresh_token' => $tokens['data']['refresh_token'],
                ]);

                return redirect()->route('intranet')->with('success','Has iniciado sesión exitosamente.');
            }else{
                // Capturamos el JSON devuelto por la API
                $error = $response->json();
                // Extraemos el mensaje si existe
                $message = $error['message'] ?? 'Ocurrió un error inesperado.';
                session()->flash('error', $message);
            }


        } catch (ValidationException $e) {
            $this->setErrorBag($e->validator->errors());
        }catch (\Exception $e){
            $this->logs->insertarLog($e);
            session()->flash('error', 'Ocurrió un error al guardar el registro. Por favor, inténtelo nuevamente.');
        }
    }
}
