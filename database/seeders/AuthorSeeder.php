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
        $names = [
            'La sencilla',
            'El Pibe',
            'La crema',
            'Chiquilla',
        ];
        
        for ($i=0; $i < count($names); $i++) { 
            Author::create([
                'name' => $names[$i],
                'description' => 'Desc de '.Str($names[$i])->slug(),
                'image' => "/dev/dev (".($i+1).").jpg",
                'system_prompt' => 'propmt de '.Str($names[$i])->slug(),
                'category_id' => mt_rand(1, 10),
                'subcategory' => Str::random(2, 5),
            ]);
        }
    }
}
