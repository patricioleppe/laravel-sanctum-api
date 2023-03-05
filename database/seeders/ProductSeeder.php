<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('products')->insert([
            "name" => "Iphone 13",
            "description" => "Mobile Phone Apple",
            "amount" => 980
        ]);
        DB::table('products')->insert([
            "name" => "Samsung Galaxy S12",
            "description" => "Mobile Phone Samsung with Android 13",
            "amount" => 580
        ]);
        DB::table('products')->insert([
            "name" => "Xaomi",
            "description" => "Mobile Phone",
            "amount" => 150
        ]);
    }
}
