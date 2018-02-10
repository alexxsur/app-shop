<?php

use Illuminate\Database\Seeder;
use App\Product;
use App\Category;
use App\ProductImage;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //model factory
        factory(Category::class,5)->create(); // create crea y guarda en BD
        factory(Product::class,100)->create(); // create crea y guarda en BD
        factory(ProductImage::class,200)->create(); // create crea y guarda en BD
        //factory(Product::class,100)->make(); make crea objetos
    }
}
