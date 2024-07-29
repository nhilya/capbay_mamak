<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\FoodMenu;

class FoodMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $products = [
            ['code' => 'B001', 'name' => 'Kopi', 'description' => 'Buy 1 Get 1 Free', 'price' => 2.5],
            ['code' => 'F001', 'name' => 'Roti Kosong', 'description' => 'RM1.20 each if buying 2 or more', 'price' => 1.5],
            ['code' => 'B002', 'name' => 'Teh Tarik', 'description' => 'Buy 1 Get 1 Free', 'price' => 2],
        ];

        foreach ($products as $product) {
            FoodMenu::create($product);
        }
    }
}
