<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = array(
            array('id' => '1','name' => 'Earphone','image' => 'products/oBfxyYOq5tbBThLvOXuFnfOqcogihhFjFnjd7VrT.png','purchase_price' => '100.00','selling_price' => '200.00','opening_stock' => '50','current_stock' => '40','created_at' => '2026-02-24 18:39:06','updated_at' => '2026-02-24 18:49:39')
        );

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
