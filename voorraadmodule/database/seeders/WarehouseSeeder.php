<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Warehouse;
use App\Models\ItemQuantityInWarehouses;
use Illuminate\Database\Seeder;

class Warehouseseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $warehouse1 = Warehouse::create(['name' =>'test1', 'street' => 'teststreet', 'housenumber' => '01', 'zipcode' => '1234AB', 'city' => 'testcity', 'country' => 'testcountry']);
        $warehouse2 = Warehouse::create(['name' =>'test2', 'street' => 'teststreet', 'housenumber' => '01', 'zipcode' => '1234AB', 'city' => 'testcity', 'country' => 'testcountry']);
        $warehouse3 = Warehouse::create(['name' =>'test3', 'street' => 'teststreet', 'housenumber' => '01', 'zipcode' => '1234AB', 'city' => 'testcity', 'country' => 'testcountry']);
        $warehouse4 = Warehouse::create(['name' =>'test4', 'street' => 'teststreet', 'housenumber' => '01', 'zipcode' => '1234AB', 'city' => 'testcity', 'country' => 'testcountry']);
        $warehouse1->save();
        $warehouse2->save();
        $warehouse3->save();
        $warehouse4->save();


        $iteminWarehouse1 = ItemQuantityInWarehouses::create(['product_id' => '1', 'warehouse_id' => 1, 'quantity' => 5]);
        $iteminWarehouse1-> save();
    }
}
