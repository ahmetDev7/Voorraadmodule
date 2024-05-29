<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use app\Model\Warehouse;
use Illuminate\Database\Seeder;

class WarehouseSeeder extends Seeder
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

    }
}
