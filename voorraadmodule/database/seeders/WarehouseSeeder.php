<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Warehouse;
use App\Models\ItemQuantityInWarehouses;
use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\ProductSerialNumber;

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

        Product::createOrFirst(['id'=> 1, 'productnummer' => '001', 'name' => 'test01', 'description' => 'testproduct1', 'category' => 'test']);
        Product::createOrFirst(['id'=> 2, 'productnummer' => '002', 'name' => 'test02', 'description' => 'testproduct2', 'category' => 'test']);


        ProductSerialNumber::create([
            'product_id' => 1,
            'serialnumber' => '001',
            'productnumber' => 'producttest2'

        ])->save();


        ProductSerialNumber::create([
            'product_id' => 2,
            'serialnumber' => '002',
            'productnumber' => 'producttest2'
        ])->save();


        $iteminWarehouse1 = ItemQuantityInWarehouses::create(['product_id' => 1, 'warehouse_id' => 1, 'serial_number' => '001']);
        $iteminWarehouse2 = ItemQuantityInWarehouses::create(['product_id' => 2, 'warehouse_id' => 1, 'serial_number' => '002']);
        $iteminWarehouse1-> save();
        $iteminWarehouse2-> save();

    }
}
