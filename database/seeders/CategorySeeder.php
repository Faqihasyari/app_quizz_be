<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Quiz;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $categories = [
            'Olahraga', 'Film', 'Musik', 'Fashion', 'Science', 'Sejarah', 'Geography', 'Technology'
        ];

        foreach ($categories as $name) {
            $category = Category::create(['name' => $name]);

            Quiz::create([
                'title' => "Quiz $name",
                'description' => "Pertanyaan seputar $name",
                'category_id' => $category->id
            ]);
        }
    }
}
