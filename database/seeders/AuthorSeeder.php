<?php

namespace Database\Seeders;

use App\Models\Author;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Author::create([
            'name' => 'Cayetana Rodriguez',
            'description' => 'Doctora en negocios y marketing digital',
            'image' => "/dev/dev (1).jpg",
            'system_prompt' => 'Empresaria joven',
            'category_id' => 4,
            'subcategory' => 'Negocios y empresas',
        ]);

        Author::create([
            'name' => 'Borja Lucio',
            'description' => 'Aruitecto y promotor de viviendas',
            'image' => "/dev/dev (2).jpg",
            'system_prompt' => 'Arquitecto, urbanista y urbanita',
            'category_id' => 5,
            'subcategory' => 'Arquitectura neovanguardista',
        ]);

        Author::create([
            'name' => 'Yaiza Guanarteme',
            'description' => 'Mujer canaria tradicional',
            'image' => "/dev/dev (3).jpg",
            'system_prompt' => 'Mujer canaria nacionalista y feminista',
            'category_id' => 2,
            'subcategory' => 'Nacionalismo y bienestar',
        ]);

        Author::create([
            'name' => '@LaPibitaCrema',
            'description' => 'Streamer de exito',
            'image' => "/dev/dev (4).jpg",
            'system_prompt' => 'Streamer de exito, stremea videojuegos, cotilleos y actualidad',
            'category_id' => 9,
            'subcategory' => 'Streamers famosos',
        ]);

        Author::create([
            'name' => 'Crispín Santaolalla',
            'description' => 'Cientifico amante de la curiosidades del universo',
            'image' => "/dev/dev (5).jpg",
            'system_prompt' => 'Cientifico loco, inventa experimentos absurdos del espacio y cuantica',
            'category_id' => 10,
            'subcategory' => 'Cuantica',
        ]);

        Author::create([
            'name' => 'Vikxo Alak',
            'description' => 'Periodista alien amante de la humanidad',
            'image' => "/dev/dev (6).jpg",
            'system_prompt' => 'Alienigena loco amante de la informatica y los viajes espaciales',
            'category_id' => 3,
            'subcategory' => 'Tecnologia alienigena',
        ]);

        Author::create([
            'name' => 'Gato misterioso',
            'description' => 'Gato naranja con capacidades humanas',
            'image' => "/dev/dev (7).jpg",
            'system_prompt' => 'Gato naranja con capacidades humanas que habla de cosas de gatos',
            'category_id' => 7,
            'subcategory' => 'Locuras de gatos',
        ]);

        Author::create([
            'name' => 'Covid Brallan',
            'description' => 'Gymbro amante del deporte',
            'image' => "/dev/dev (8).jpg",
            'system_prompt' => 'Amante del deporte de motor',
            'category_id' => 8,
            'subcategory' => 'Formula 1',
        ]);
    }
}
