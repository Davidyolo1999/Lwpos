<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Product::create([
            'name' => 'Atún en lata',
            'cost' => 20,
            'price' => 22,
            'barcode' => 123456789,
            'stock' => 1000,
            'alerts' => 50,
            'category_id' => 1,
            'image' => 'curso.png'
        ]);
        Product::create([
            'name' => 'Aceite 123',
            'cost' => 30,
            'price' => 35,
            'barcode' => 123456788,
            'stock' => 1000,
            'alerts' => 50,
            'category_id' => 1,
            'image' => 'curso.png'
        ]);
        Product::create([
            'name' => 'Aceitunas en lata',
            'cost' => 40,
            'price' => 45,
            'barcode' => 123456888,
            'stock' => 1000,
            'alerts' => 50,
            'category_id' => 1,
            'image' => 'curso.png'
        ]);
        Product::create([
            'name' => 'Azúcar',
            'cost' => 22,
            'price' => 24,
            'barcode' => 123458888,
            'stock' => 1000,
            'alerts' => 50,
            'category_id' => 1,
            'image' => 'curso.png'
        ]);
        Product::create([
            'name' => 'Leche',
            'cost' => 18,
            'price' => 20,
            'barcode' => 123488888,
            'stock' => 1000,
            'alerts' => 50,
            'category_id' => 1,
            'image' => 'curso.png'
        ]);
        //
        Product::create([
            'name' => 'Agua natural',
            'cost' => 8,
            'price' => 10,
            'barcode' => 123888888,
            'stock' => 1000,
            'alerts' => 50,
            'category_id' => 2,
            'image' => 'curso.png'
        ]);
        Product::create([
            'name' => 'Cerveza',
            'cost' => 35,
            'price' => 45,
            'barcode' => 128888888,
            'stock' => 1000,
            'alerts' => 50,
            'category_id' => 3,
            'image' => 'curso.png'
        ]);
        Product::create([
            'name' => 'Papas',
            'cost' => 13,
            'price' => 15,
            'barcode' => 188888888,
            'stock' => 1000,
            'alerts' => 50,
            'category_id' => 4,
            'image' => 'curso.png'
        ]);
        Product::create([
            'name' => 'Chocolate en barra',
            'cost' => 15,
            'price' => 18,
            'barcode' => 888888888,
            'stock' => 1000,
            'alerts' => 50,
            'category_id' => 5,
            'image' => 'curso.png'
        ]);
        Product::create([
            'name' => 'Bolis',
            'cost' => 8,
            'price' => 10,
            'barcode' => 988888888,
            'stock' => 1000,
            'alerts' => 50,
            'category_id' => 6,
            'image' => 'curso.png'
        ]);
        Product::create([
            'name' => 'Cloro',
            'cost' => 10,
            'price' => 14,
            'barcode' => 998888888,
            'stock' => 1000,
            'alerts' => 50,
            'category_id' => 7,
            'image' => 'curso.png'
        ]);
        Product::create([
            'name' => 'Cepillo de dientes',
            'cost' => 22,
            'price' => 24,
            'barcode' => 999888888,
            'stock' => 1000,
            'alerts' => 50,
            'category_id' => 8,
            'image' => 'curso.png'
        ]);
        Product::create([
            'name' => 'Pan molido',
            'cost' => 20,
            'price' => 23,
            'barcode' => 999998888,
            'stock' => 1000,
            'alerts' => 50,
            'category_id' => 9,
            'image' => 'curso.png'
        ]);
        Product::create([
            'name' => 'Jamón',
            'cost' => 39,
            'price' => 44,
            'barcode' => 999999888,
            'stock' => 1000,
            'alerts' => 50,
            'category_id' => 10,
            'image' => 'curso.png'
        ]);
        Product::create([
            'name' => 'Cerillos',
            'cost' => 2,
            'price' => 4,
            'barcode' => 999999988,
            'stock' => 1000,
            'alerts' => 50,
            'category_id' => 11,
            'image' => 'curso.png'
        ]);

    }
}
