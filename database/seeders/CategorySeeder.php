<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Category::create([
            'name' => 'Productos de despensa general',
            'image' => 'https://dummyimage.com/600x400/000/fff'
        ]);

        Category::create([
            'name' => 'Bebidas sin alcohol',
            'image' => 'https://dummyimage.com/600x400/000/fff'
        ]);
        Category::create([
            'name' => 'Bebidas alcohólicas',
            'image' => 'https://dummyimage.com/600x400/000/fff'
        ]);
        Category::create([
            'name' => 'Botanas',
            'image' => 'https://dummyimage.com/600x400/000/fff'
        ]);
        Category::create([
            'name' => 'Confitería',
            'image' => 'https://dummyimage.com/600x400/000/fff'
        ]);
        Category::create([
            'name' => 'Fríos',
            'image' => 'https://dummyimage.com/600x400/000/fff'
        ]);
        Category::create([
            'name' => 'Jarciería',
            'image' => 'https://dummyimage.com/600x400/000/fff'
        ]);
        Category::create([
            'name' => 'Higiene personal',
            'image' => 'https://dummyimage.com/600x400/000/fff'
        ]);
        Category::create([
            'name' => 'Harinas y pan',
            'image' => 'https://dummyimage.com/600x400/000/fff'
        ]);
        Category::create([
            'name' => 'Carnes y Embutidos',
            'image' => 'https://dummyimage.com/600x400/000/fff'
        ]);
        Category::create([
            'name' => 'Uso doméstico',
            'image' => 'https://dummyimage.com/600x400/000/fff'
        ]);
    }
}
