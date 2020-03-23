<?php

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            'name' => "Product#" . mt_rand(0, 5000),
            'code' => "PP0320" . mt_rand(1, 5000),
            'stock' => mt_rand(0, 1000),
            'uom' => Str::random(3),
            'price' => mt_rand(0, 10000) / 100,
        ]);
    }
}
