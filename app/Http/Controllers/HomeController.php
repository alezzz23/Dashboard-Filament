<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function inscripcion()
    {
        return view('inscripcion');
    }

    public function procesarInscripcion(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'telefono' => 'required|string|max:20',
            'especialidad' => 'required|string|max:255',
            'cedula' => 'required|string|max:20',
            'institucion' => 'nullable|string|max:255',
            'evento' => 'required|in:curso,jornada,ambos',
            'modalidad' => 'required|in:presencial,virtual',
            'terminos' => 'required|accepted'
        ], [
            'nombre.required' => 'El nombre es obligatorio',
            'apellido.required' => 'El apellido es obligatorio',
            'email.required' => 'El email es obligatorio',
            'email.email' => 'El email debe tener un formato válido',
            'telefono.required' => 'El teléfono es obligatorio',
            'especialidad.required' => 'La especialidad es obligatoria',
            'cedula.required' => 'La cédula es obligatoria',
            'evento.required' => 'Debe seleccionar al menos un evento',
            'modalidad.required' => 'Debe seleccionar una modalidad',
            'terminos.accepted' => 'Debe aceptar los términos y condiciones'
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Por favor, corrija los errores en el formulario');
        }

        try {
            // Aquí enviarías el email de confirmación
            // Mail::to($request->email)->send(new InscripcionConfirmada($request->all()));
            
            return redirect()
                ->route('home')
                ->with('success', '¡Inscripción exitosa! Te contactaremos pronto con los detalles de pago.');
            
        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->with('error', 'Error al procesar la inscripción. Inténtalo de nuevo.');
        }
    }

    public function contacto()
    {
        return view('contacto');
    }

    public function procesarContacto(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'telefono' => 'nullable|string|max:20',
            'asunto' => 'required|string|max:255',
            'mensaje' => 'required|string|max:2000'
        ], [
            'nombre.required' => 'El nombre es obligatorio',
            'email.required' => 'El email es obligatorio',
            'email.email' => 'El email debe tener un formato válido',
            'asunto.required' => 'El asunto es obligatorio',
            'mensaje.required' => 'El mensaje es obligatorio',
            'mensaje.max' => 'El mensaje no puede exceder los 2000 caracteres'
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Por favor, corrija los errores en el formulario');
        }

        try {
            // Aquí enviarías el email de contacto
            // Mail::to('admin@curso-rodilla.com')->send(new ContactoRecibido($request->all()));
            
            return back()
                ->with('success', '¡Mensaje enviado exitosamente! Te responderemos pronto.');
            
        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->with('error', 'Error al enviar el mensaje. Inténtalo de nuevo.');
        }
    }

    public function programa()
    {
        return view('programa');
    }

    public function ponentes()
    {
        return view('ponentes');
    }

    public function ubicacion()
    {
        return view('ubicacion');
    }
}