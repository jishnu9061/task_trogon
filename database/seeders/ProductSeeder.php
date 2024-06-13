<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            [
                'name' => 'Product A',
                'price' => 20.00,
                'quantity' => 30,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Product B',
                'price' => 10.00,
                'quantity' => 50,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Product C',
                'price' => 40.00,
                'quantity' => 70,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Product D',
                'price' => 30.00,
                'quantity' => 20,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}

