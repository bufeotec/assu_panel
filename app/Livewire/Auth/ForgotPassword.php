<?php

namespace App\Livewire\Auth;

use App\Models\Log;
use Illuminate\Support\Facades\Http;
use Livewire\Component;
use Illuminate\Validation\ValidationException;
class ForgotPassword extends Component
{
    private $log;
    public $email;
    public function __construct()
    {
        $this->log = new Log();
    }

    public function render()
    {
        return view('livewire.auth.forgot-password');
    }
    public function enviarCorreo()
    {
        try {

            $this->validate([
                'email' => ['required', 'email'],
            ], [
                'email.required' => 'El campo de correo electrónico es obligatorio. Por favor, ingresa tu correo.',
                'email.email' => 'El correo electrónico ingresado no es válido. Asegúrate de que tenga el formato correcto (por ejemplo: usuario@dominio.com).',
            ]);

            $response = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->post(env('APP_URL_AUTH').'api/v1/auth/reset-password/email', [
                'email' => $this->email,
            ]);

            if ($response->successful()) {

                $res = $response->json();
                $message = $res['message'] ?? 'Ocurrió un error inesperado.';

                session()->flash('success', $message);

            }else{
                $error = $response->json();
                $message = $error['message'] ?? 'Ocurrió un error inesperado.';
                session()->flash('error', $message);
            }

        }catch (ValidationException $e) {
            $this->setErrorBag($e->validator->errors());
        } catch (\Exception $e) {
            $this->log->insertarLog($e);
            session()->flash('error', 'Ocurrió un error al guardar el registro. Por favor, inténtelo nuevamente.');
        }
    }
}
