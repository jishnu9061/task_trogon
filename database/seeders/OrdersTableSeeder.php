<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('orders')->insert([
            ['order_date' => '2024-06-01', 'status' => 'Pending'],
            ['order_date' => '2024-05-25', 'status' => 'Pending'],
            ['order_date' => '2024-06-05', 'status' => 'Processing'],
            ['order_date' => '2024-05-01', 'status' => 'Processing'],
            ['order_date' => '2024-04-20', 'status' => 'Cancelled'],
            ['order_date' => '2024-06-10', 'status' => 'Shipped'],
        ]);
    }
}
