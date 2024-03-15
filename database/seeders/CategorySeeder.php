<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $titles = [
            'General',
            'Política',//
            'Tecnología',//
            'Actualidad',//
            'Arquitectura',//
            'Moda',
            'Humor',//
            'Deportes',
            'Salseo',//
            'Ciencia',//
        ];
        
        for ($i=0; $i < count($titles); $i++) { 
            Category::create([
                'title' => $titles[$i],
                'slug' => Str($titles[$i])->slug(),
                'image' => null,
                'text' => 'Categoría sobre '.$titles[$i],
            ]);
        }
    }
}
