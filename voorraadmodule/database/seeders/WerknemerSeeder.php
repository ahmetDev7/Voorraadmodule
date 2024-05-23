<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class WerknemerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('werknemers')->insert([
            [
                'name' => 'John Doe',
                'email' => 'john.doe@example.com',
                'functie' => 'Monteur',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Jane Smith',
                'email' => 'jane.smith@example.com',
                'functie' => 'Monteur',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Bob Johnson',
                'email' => 'bob.johnson@example.com',
                'functie' => 'Designer',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
