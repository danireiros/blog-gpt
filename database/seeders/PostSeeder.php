<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i=0; $i < 50; $i++) { 
            $title = Str::random(50, 150);
            Post::create([
                'title' => $title,
                'slug' => Str($title)->slug(),
                'image' => "/dev/dev (".mt_rand(1, 4).").jpg",
                'text' => Str::random(20, 150),
                'description' => Str::random(20, 40),
                'posted' => ['yes','not'][rand(0,1)],
                'type' => ['ad', 'post', 'course', 'movie'][rand(0,3)],
                'category_id' => mt_rand(1, 10),
                'author_id' => mt_rand(1, 4),
            ]);
        }
    }
}
