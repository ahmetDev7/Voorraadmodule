<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Werknemer;
use App\Models\Product;

class WerknemerProductSeeder extends Seeder
{
    public function run()
    {
        $werknemer1 = Werknemer::create(['name' => 'John Doe', 'email' => 'john@example.com', 'functie' => 'Monteur']);
        $werknemer2 = Werknemer::create(['name' => 'Jane Smith', 'email' => 'jane@example.com', 'functie' => 'Monteur']);

        $product1 = Product::create([
            'productnummer' => '005',
            'name' => 'Product 1',
            'description' => 'niet van toepassing',
            'category' => 'Gereedschap',
        ]);

        $product2 = Product::create([
            'productnummer' => '006',
            'name' => 'Product 2',
            'description' => 'niet van toepassing',
            'category' => 'Gereedschap',
        ]);

        $werknemer1->products()->attach($product1->id, ['quantity' => 5]);
        $werknemer1->products()->attach($product2->id, ['quantity' => 3]);
        $werknemer2->products()->attach($product1->id, ['quantity' => 2]);
    }
}
