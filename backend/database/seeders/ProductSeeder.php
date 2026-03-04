<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        \App\Models\Product::create([
            'name' => 'iPhone 15 Pro',
            'sku' => 'IP15P',
            'price' => 25000000,
            'stock' => 10,
            'description' => 'Hàng chính hãng VN/A'
        ]);
    }
}
