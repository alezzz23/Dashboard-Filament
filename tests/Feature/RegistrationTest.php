<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;
use Illuminate\Support\Str;

class RegistrationTest extends TestCase
{
    use RefreshDatabase, WithFaker;
    
    // This will run migrations on the SQLite testing database
    // and roll them back after each test
    use RefreshDatabase, WithFaker;
    
    protected function setUp(): void
    {
        parent::setUp();
        
        // Limpiar directorios de almacenamiento
        Storage::disk('public')->deleteDirectory('fotos');
        Storage::disk('public')->deleteDirectory('carnets');
        Storage::disk('public')->makeDirectory('fotos');
        Storage::disk('public')->makeDirectory('carnets');
    }

    /** @test */
    public function it_can_register_a_new_user()
    {
        // Skip if not in testing environment
        if (app()->environment() !== 'testing') {
            $this->markTestSkipped('This test must be run in the testing environment');
            return;
        }

        // Generate unique test data
        $uniqueId = Str::random(8);
        $cedula = 'V' . $this->faker->unique()->numerify('########');
        $email = 'test_' . $uniqueId . '@example.com';
        
        // Create a fake image for testing
        $file = UploadedFile::fake()->image('test-photo.jpg');
        
        // Make the POST request to register a new user
        $response = $this->post('/registro', [
            'nombre' => 'Test User ' . $uniqueId,
            'cedula' => $cedula,
            'email' => $email,
            'telefono' => '0412' . $this->faker->numerify('#######'),
            'profesion' => 'estudiante_pregrado',
            'foto' => $file,
        ]);

        // Assert the response is a redirect with success message
        $response->assertStatus(302);
        $response->assertSessionHas('success');

        // Check if the record was saved to the database
        $this->assertDatabaseHas('inscripciones', [
            'nombre' => 'Test User ' . $uniqueId,
            'cedula' => $cedula,
            'email' => $email,
            'profesion' => 'estudiante_pregrado',
        ]);
        
        // Verify the photo was stored
        $record = DB::table('inscripciones')
            ->where('cedula', $cedula)
            ->first();
            
        $this->assertNotNull($record, 'Record was not saved to the database');
        
        if ($record && $record->foto_path) {
            $this->assertTrue(
                Storage::disk('public')->exists($record->foto_path),
                'Photo file was not stored at the expected path: ' . $record->foto_path
            );
        } else {
            $this->fail('Photo path was not saved in the database');
        }
    }

    /** @test */
    public function it_validates_required_fields()
    {
        // Skip if not in testing environment
        if (app()->environment() !== 'testing') {
            $this->markTestSkipped('This test must be run in the testing environment');
            return;
        }
        
        // Test with empty data
        $response = $this->post('/registro', []);
        
        // Should redirect back with validation errors
        $response->assertStatus(302);
        
        // Check for all required field errors
        $response->assertSessionHasErrors([
            'nombre', 
            'cedula', 
            'email', 
            'telefono', 
            'profesion',
            'foto'
        ]);
        
        // Test with invalid email
        $response = $this->post('/registro', [
            'email' => 'invalid-email',
        ]);
        
        $response->assertSessionHasErrors(['email']);
    }

    /** @test */
    public function it_validates_cedula_is_unique()
    {
        // Skip if not in testing environment
        if (app()->environment() !== 'testing') {
            $this->markTestSkipped('This test must be run in the testing environment');
            return;
        }
        
        // Generate a unique cedula for this test
        $cedula = 'V' . $this->faker->unique()->numerify('########');
        $uniqueId = Str::random(8);
        
        // Create a fake image for testing
        $file = UploadedFile::fake()->image('test-photo.jpg');
        
        // First registration - should succeed
        $response1 = $this->post('/registro', [
            'nombre' => 'First User ' . $uniqueId,
            'cedula' => $cedula,
            'email' => 'first_' . $uniqueId . '@example.com',
            'telefono' => '0412' . $this->faker->numerify('#######'),
            'profesion' => 'estudiante_pregrado',
            'foto' => $file,
        ]);
        
        // Should redirect with success
        $response1->assertStatus(302);
        $response1->assertSessionHas('success');
        
        // Verify the first record was created
        $this->assertDatabaseHas('inscripciones', [
            'cedula' => $cedula,
            'email' => 'first_' . $uniqueId . '@example.com',
        ]);

        // Create a new file for the second registration
        $file2 = UploadedFile::fake()->image('test-photo2.jpg');
        
        // Second registration with same cedula - should fail
        $response2 = $this->post('/registro', [
            'nombre' => 'Second User ' . $uniqueId,
            'cedula' => $cedula, // Same cedula
            'email' => 'second_' . $uniqueId . '@example.com',
            'telefono' => '0412' . $this->faker->numerify('#######'),
            'profesion' => 'estudiante_pregrado',
            'foto' => $file2,
        ]);

        // Should redirect back with validation error
        $response2->assertStatus(302);
        $response2->assertSessionHasErrors(['cedula']);
        
        // Verify only one record exists with this cedula
        $count = DB::table('inscripciones')
            ->where('cedula', $cedula)
            ->count();
            
        $this->assertEquals(1, $count, 'More than one record was created with the same cedula');
    }
}
