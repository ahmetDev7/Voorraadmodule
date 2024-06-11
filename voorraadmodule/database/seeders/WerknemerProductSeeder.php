<?php

namespace Database\Seeders;

use App\Models\ProductSerialNumber;
use App\Models\werknemer_product;
use Illuminate\Database\Seeder;
use App\Models\Werknemer;
use App\Models\Product;

class WerknemerProductSeeder extends Seeder
{
    public function run()
    {
        Werknemer::create(['name' => 'John Doe', 'email' => 'john@example.com', 'functie' => 'Monteur'])->save();
        Werknemer::create(['name' => 'Jane Smith', 'email' => 'jane@example.com', 'functie' => 'Monteur'])->save();

        $product1 = Product::createOrFirst(['id'=> 1, 'productnummer' => '001', 'name' => 'test01', 'description' => 'testproduct1', 'category' => 'test']);
        $product2 = Product::createOrFirst(['id'=> 2, 'productnummer' => '002', 'name' => 'test02', 'description' => 'testproduct2', 'category' => 'test']);



        ProductSerialNumber::create([
            'product_id' => 1,
            'serialnumber' => 'werknemertest1',
            'productnumber' => 'producttest2'

        ])->save();

        $testserienummer1 = ProductSerialNumber::where('serialnumber', 'werknemertest1',)->first();

        ProductSerialNumber::create([
            'product_id' => 2,
            'serialnumber' => 'werknemertest2',
            'productnumber' => 'producttest2'
        ])->save();

        $testserienummer2 = ProductSerialNumber::where('serialnumber', 'werknemertest2',)->first();

        $product1 = werknemer_product::create([
            'werknemer_id' => 1,
            'serialnumber_id' => $testserienummer1->id
        ]);
        $product1->save();
        $product2 = werknemer_product::create([
            'werknemer_id' => 1,
            'serialnumber_id' =>  $testserienummer2->id,
        ]);
        $product2->save();
    }
}
