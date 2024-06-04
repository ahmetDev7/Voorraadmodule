<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Product;
use Illuminate\Database\Seeder;

class Productseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $product1 = Product::create(['productnummer' => '001', 'name' => 'test01', 'description' => 'testproduct1', 'category' => 'test']);
        $product2 = Product::create(['productnummer' => '002', 'name' => 'test02', 'description' => 'testproduct2', 'category' => 'test']);
        $product3 = Product::create(['productnummer' => '001', 'name' => 'test03', 'description' => 'testproduct3', 'category' => 'test']);
        $product4 = Product::create(['productnummer' => '001', 'name' => 'test04', 'description' => 'testproduct4', 'category' => 'test']);
        $product1->save();
        $product2->save();
        $product3->save();
        $product4->save();
    }
}
