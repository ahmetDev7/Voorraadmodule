<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Werknemer;
use App\Models\Product;

class WerknemerProductSeeder extends Seeder
{
    public function run()
    {
        $werknemer1 = Werknemer::create(['name' => 'John Doe', 'email' => 'john@example.com', 'functie' => 'Manager']);
        $werknemer2 = Werknemer::create(['name' => 'Jane Smith', 'email' => 'jane@example.com', 'functie' => 'Developer']);

        $product1 = Product::create([
            'productnummer' => 'P001',
            'name' => 'Product 1',
            'description' => 'Description of Product 1',
            'category' => 'Category 1',
            'warehouse_id' => 1
        ]);

        $product2 = Product::create([
            'productnummer' => 'P002',
            'name' => 'Product 2',
            'description' => 'Description of Product 2',
            'category' => 'Category 2',
            'warehouse_id' => 1
        ]);

        $werknemer1->products()->attach($product1->id, ['quantity' => 5]);
        $werknemer1->products()->attach($product2->id, ['quantity' => 3]);
        $werknemer2->products()->attach($product1->id, ['quantity' => 2]);
    }
}
