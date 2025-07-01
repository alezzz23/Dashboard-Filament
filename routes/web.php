<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\RegistroController;

Route::get('/', function () {
    return view('welcome');
});

// Debug route to check database connection and table structure
Route::get('/debug/db-check', function () {
    try {
        // Test database connection
        DB::connection()->getPdo();
        
        // Check if inscripciones table exists
        $tableExists = DB::getSchemaBuilder()->hasTable('inscripciones');
        
        if ($tableExists) {
            try {
                $columns = DB::select('SHOW COLUMNS FROM inscripciones');
                $tableInfo = [];
                
                foreach ($columns as $column) {
                    $tableInfo[] = [
                        'Field' => $column->Field,
                        'Type' => $column->Type,
                        'Null' => $column->Null,
                        'Key' => $column->Key,
                        'Default' => $column->Default,
                        'Extra' => $column->Extra
                    ];
                }
                
                return response()->json([
                    'status' => 'success',
                    'message' => 'Database connection successful',
                    'table_exists' => true,
                    'table_name' => 'inscripciones',
                    'table_columns' => $tableInfo,
                    'test_insert' => 'Table structure looks good!'
                ]);
            } catch (\Exception $e) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Error accessing table structure',
                    'error' => $e->getMessage(),
                    'trace' => $e->getTraceAsString()
                ], 500);
            }
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Table inscripciones does not exist',
                'suggestion' => 'Run "php artisan migrate" to create the table'
            ]);
        }
    } catch (\Exception $e) {
        return response()->json([
            'status' => 'error',
            'message' => 'Could not connect to the database',
            'error' => $e->getMessage(),
            'suggestion' => 'Check your .env file for correct database credentials'
        ], 500);
    }
});

// Test route to check if we can insert into the inscripciones table
Route::get('/test-insert', function() {
    try {
        $testData = [
            'codigo_inscripcion' => 'TEST-' . strtoupper(Str::random(8)),
            'nombre' => 'Test User',
            'cedula' => 'V' . rand(1000000, 99999999),
            'email' => 'test' . time() . '@example.com',
            'telefono' => '0412' . rand(1000000, 9999999),
            'profesion' => 'estudiante_pregrado',
            'fecha_registro' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
        
        $id = DB::table('inscripciones')->insertGetId($testData);
        
        return response()->json([
            'status' => 'success',
            'message' => 'Test record inserted successfully',
            'record_id' => $id,
            'test_data' => $testData
        ]);
        
    } catch (\Exception $e) {
        return response()->json([
            'status' => 'error',
            'message' => 'Failed to insert test record',
            'error' => $e->getMessage(),
            'trace' => $e->getTraceAsString()
        ], 500);
    }
});

// Registration Routes
Route::get('/registro', [RegistroController::class, 'showRegistrationForm'])->name('registro.form');
Route::post('/registro', [RegistroController::class, 'register'])->name('registro.store');
