<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

use Carbon\Carbon;

class RegistroController extends Controller
{
    /**
     * Show the registration form
     */
    public function showRegistrationForm()
    {
        return redirect()->to('/#registro');
    }

    /**
     * Handle registration form submission
     */
    public function register(Request $request)
    {
        // Log the incoming request data for debugging
        \Log::info('Registration attempt', ['data' => $request->all()]);
        
        try {
            // Validate the request data
            $validated = $request->validate([
                'nombre' => 'required|string|max:100',
                'cedula' => 'required|string|max:20|unique:inscripciones,cedula',
                'email' => 'required|email|max:100',
                'telefono' => 'required|string|max:20',
                'profesion' => 'required|string|in:estudiante_pregrado,estudiante_postgrado,docente,investigador,profesional,otro',
                'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            ], [
                'cedula.unique' => 'La cédula ingresada ya está registrada.',
                'email.email' => 'El formato del correo electrónico no es válido.',
                'required' => 'El campo :attribute es obligatorio.',
                'max' => 'El campo :attribute no debe tener más de :max caracteres.',
                'image' => 'El archivo debe ser una imagen válida.',
                'mimes' => 'La imagen debe ser de tipo: jpeg, png, jpg.',
                'foto.max' => 'La imagen no debe pesar más de 2MB.',
            ]);
            // Generate a unique registration code
            $codigoInscripcion = 'INSC-' . strtoupper(Str::random(8));
            $fechaRegistro = now();

            // Handle photo upload if present
            $fotoPath = null;
            if ($request->hasFile('foto')) {
                try {
                    $foto = $request->file('foto');
                    $filename = time() . '_' . preg_replace('/[^A-Za-z0-9\.]/', '_', $validated['cedula']) . '.' . $foto->getClientOriginalExtension();
                    $fotoPath = 'fotos/' . $filename;
                    
                    // Store the original photo
                    $path = $foto->storeAs('public/fotos', $filename);
                    \Log::info('Photo stored successfully', ['path' => $path]);
                } catch (\Exception $e) {
                    \Log::error('Error storing photo: ' . $e->getMessage());
                    return back()
                        ->withInput()
                        ->withErrors(['foto' => 'Error al subir la imagen. Por favor, inténtalo de nuevo.']);
                }
            }

            // Insert into database
            try {
                $id = DB::table('inscripciones')->insertGetId([
                    'codigo_inscripcion' => $codigoInscripcion,
                    'nombre' => $validated['nombre'],
                    'cedula' => $validated['cedula'],
                    'email' => $validated['email'],
                    'telefono' => $validated['telefono'],
                    'profesion' => $validated['profesion'],
                    'fecha_registro' => $fechaRegistro,
                    'foto_path' => $fotoPath,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
                
                \Log::info('Registration saved to database', ['id' => $id]);
                
            } catch (\Exception $e) {
                \Log::error('Database error: ' . $e->getMessage());
                // If there was an error, delete the uploaded photo if it exists
                if (isset($path) && Storage::disk('public')->exists($fotoPath)) {
                    Storage::disk('public')->delete($fotoPath);
                }
                
                return back()
                    ->withInput()
                    ->withErrors(['error' => 'Error al guardar en la base de datos. Por favor, inténtalo de nuevo.']);
            }

            // Prepare data for frontend generation
            $fotoUrl = $fotoPath ? Storage::url($fotoPath) : null;
            $registroData = [
                'nombre' => $validated['nombre'],
                'cedula' => $validated['cedula'],
                'codigo_inscripcion' => $codigoInscripcion,
                'fecha' => $fechaRegistro->format('d/m/Y'),
                'foto' => $fotoUrl,
            ];

            return back()
                ->with('success', '¡Registro exitoso! Tu código de inscripción es: ' . $codigoInscripcion)
                ->with('registro_data', $registroData);

        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->withErrors(['error' => 'Ocurrió un error al procesar tu registro. Por favor, inténtalo de nuevo.']);
        }
    }

    /**
     * Generate ID card image
     */
    private function generateIdCard($data)
    {
        try {
            \Log::info('Starting ID card generation', ['data' => $data]);
            
            // Verify font exists
            $fontPath = public_path('fonts/arial.ttf');
            if (!file_exists($fontPath)) {
                throw new \Exception("Font file not found at: " . $fontPath);
            }
            \Log::info('Font file found', ['path' => $fontPath]);
            
            // Verify photo exists if provided
            if (!empty($data['foto']) && !file_exists($data['foto'])) {
                \Log::warning('Photo file not found', ['path' => $data['foto']]);
                $data['foto'] = null; // Continue without photo
            }
            
            // Create a new image with a white background
            $img = Image::canvas(800, 500, '#ffffff');
            \Log::info('Image canvas created');
            
            // Add background pattern or color
            $img->rectangle(0, 0, 800, 500, function ($draw) {
                $draw->background('#f8f9fa');
            });
            \Log::info('Background added');
            
            // Add header
            $img->text('III JORNADA CIENTÍFICA 2025', 400, 50, function($font) use ($fontPath) {
                $font->file($fontPath);
                $font->size(28);
                $font->color('#2c3e50');
                $font->align('center');
                $font->valign('top');
            });
            \Log::info('Header text added');
            
            // Add photo if available
            if (!empty($data['foto']) && file_exists($data['foto'])) {
                $photo = Image::make($data['foto']);
                $photo->fit(200, 250);
                $img->insert($photo, 'left', 50, 100);
                \Log::info('Photo added to ID card');
            } else {
                \Log::info('No photo to add to ID card');
            }
            
            // Add user information
            $y = 120;
            $img->text('Nombre: ' . $data['nombre'], 300, $y, function($font) use ($fontPath) {
                $font->file($fontPath);
                $font->size(18);
                $font->color('#2c3e50');
            });
            
            $y += 40;
            $img->text('Cédula: ' . $data['cedula'], 300, $y, function($font) use ($fontPath) {
                $font->file($fontPath);
                $font->size(18);
                $font->color('#2c3e50');
            });
            
            $y += 40;
            $img->text('Código: ' . $data['codigo'], 300, $y, function($font) use ($fontPath) {
                $font->file($fontPath);
                $font->size(18);
                $font->color('#2c3e50');
            });
            
            $y += 40;
            $img->text('Fecha: ' . $data['fecha'], 300, $y, function($font) use ($fontPath) {
                $font->file($fontPath);
                $font->size(18);
                $font->color('#2c3e50');
            });
            
            // Add footer
            $img->text('Este carnet es personal e intransferible', 400, 450, function($font) use ($fontPath) {
                $font->file($fontPath);
                $font->size(16);
                $font->color('#7f8c8d');
                $font->align('center');
            });
            
            // Add border
            $img->rectangle(0, 0, 799, 499, function ($draw) {
                $draw->border(2, '#2c3e50');
            });
        
            // Save the image
            $filename = 'carnets/carnet_' . $data['cedula'] . '_' . time() . '.png';
            $path = storage_path('app/public/' . $filename);
            
            // Ensure directory exists
            $directory = dirname($path);
            if (!file_exists($directory)) {
                mkdir($directory, 0777, true);
            }
            
            // Save the image
            $img->save($path);
            
            // Generate public URL for the saved image
            $publicUrl = Storage::url($filename);
            \Log::info('ID card saved successfully', [
                'path' => $path,
                'public_url' => $publicUrl
            ]);
            
            return $publicUrl;
            
        } catch (\Exception $e) {
            \Log::error('Error generating ID card: ' . $e->getMessage(), [
                'exception' => $e,
                'trace' => $e->getTraceAsString()
            ]);
            throw $e; // Re-throw the exception to be handled by the caller
        }
    }
}
