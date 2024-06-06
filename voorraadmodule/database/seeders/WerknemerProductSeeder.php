<?php

namespace Database\Seeders;

use App\Models\ProductSerialNumber;
use App\Models\werknemer_product;
use Illuminate\Database\Seeder;
use App\Models\Werknemer;

class WerknemerProductSeeder extends Seeder
{
    public function run()
    {
        Werknemer::create(['name' => 'John Doe', 'email' => 'john@example.com', 'functie' => 'Monteur'])->save();
        Werknemer::create(['name' => 'Jane Smith', 'email' => 'jane@example.com', 'functie' => 'Monteur'])->save();

        ProductSerialNumber::create([
            'product_id' => 1,
            'serialnumber' => 'werknemertest1',
            'productnumber' => 'producttest2'

        ])->save();

        ProductSerialNumber::create([
            'product_id' => 2,
            'serialnumber' => 'werknemertest2',
            'productnumber' => 'producttest2'
        ])->save();


        $product1 = werknemer_product::create([
            'werknemer_id' => 1,
            'serialnumber_id' => 1,
        ]);
        $product1->save();
        $product2 = werknemer_product::create([
            'werknemer_id' => 1,
            'serialnumber_id' => 2,
        ]);
        $product2->save();
    }
}
