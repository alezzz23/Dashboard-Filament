<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Post;
use App\Models\Comment;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Crear usuarios
        $usuarios = [
            User::factory()->create([
                'name' => 'Administrador Principal',
                'email' => 'admin@ejemplo.com',
            ]),
            User::factory()->create([
                'name' => 'María González',
                'email' => 'maria.gonzalez@ejemplo.com',
            ]),
            User::factory()->create([
                'name' => 'Juan Pérez',
                'email' => 'juan.perez@ejemplo.com',
            ]),
        ];

        // Crear categorías
        $categorias = [
            Category::create(['nombre' => 'Tecnología']),
            Category::create(['nombre' => 'Cultura']),
            Category::create(['nombre' => 'Educación']),
        ];

        // Crear etiquetas
        $etiquetas = [
            Tag::create(['nombre' => 'Innovación']),
            Tag::create(['nombre' => 'Tendencias']),
            Tag::create(['nombre' => 'Aprendizaje']),
        ];

        // Crear posts
        $posts = [
            Post::create([
                'titulo' => 'Avances en Inteligencia Artificial',
                'contenido' => 'La inteligencia artificial está transformando la sociedad de manera significativa.',
                'estado' => 'publicado',
                'user_id' => $usuarios[0]->id,
                'category_id' => $categorias[0]->id,
            ]),
            Post::create([
                'titulo' => 'El valor de la educación continua',
                'contenido' => 'La formación permanente es clave para el desarrollo profesional.',
                'estado' => 'publicado',
                'user_id' => $usuarios[1]->id,
                'category_id' => $categorias[2]->id,
            ]),
            Post::create([
                'titulo' => 'Tendencias culturales actuales',
                'contenido' => 'Las nuevas generaciones están marcando el rumbo de la cultura.',
                'estado' => 'borrador',
                'user_id' => $usuarios[2]->id,
                'category_id' => $categorias[1]->id,
            ]),
        ];

        // Asignar etiquetas a los posts
        $posts[0]->tags()->attach([$etiquetas[0]->id, $etiquetas[1]->id]);
        $posts[1]->tags()->attach([$etiquetas[2]->id]);
        $posts[2]->tags()->attach([$etiquetas[1]->id]);

        // Crear comentarios
        Comment::create([
            'contenido' => 'Excelente artículo, muy informativo.',
            'post_id' => $posts[0]->id,
            'user_id' => $usuarios[1]->id,
        ]);
        Comment::create([
            'contenido' => 'Comparto totalmente la opinión.',
            'post_id' => $posts[1]->id,
            'user_id' => $usuarios[2]->id,
        ]);
        Comment::create([
            'contenido' => 'Interesante perspectiva sobre la cultura.',
            'post_id' => $posts[2]->id,
            'user_id' => $usuarios[0]->id,
        ]);
    }
}
