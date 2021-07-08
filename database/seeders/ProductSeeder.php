<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProductCategory;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\File;


class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category1 = ProductCategory::create([
            'name' => 'Olahan Susu'
        ]);
        $category2 = ProductCategory::create([
            'name' => 'Olahan Daging'
        ]);
        $product1 = Product::create([
            'category_id' => $category1->id,
            'name' => 'Susu Kambing Murni',
            'detail' => 'Susu Kambing Murni Dalam Kemasan'
        ]);
        $product2 = Product::create([
            'category_id' => $category2->id,
            'name' => 'Daging Kambing Segar',
            'detail' => 'Daging kambing segar cocok diolah menjadi aneka olahan penambah gizi'
        ]);
        $product3 = Product::create([
            'category_id' => $category1->id,
            'name' => 'Milky Jelly Drink',
            'detail' => 'Milky Jelly Drink Aneka Rasa Dalam Kemasan'
        ]);
        $product4 = Product::create([
            'category_id' => $category2->id,
            'name' => 'Sate Beku',
            'detail' => 'Sate Beku Dalam Kemasan'
        ]);
        $product5 = Product::create([
            'category_id' => $category2->id,
            'name' => 'Rendang Daging Kambing',
            'detail' => 'Rendang Daging Kambing Dalam Kemasan'
        ]);
        $product6 = Product::create([
            'category_id' => $category2->id,
            'name' => 'Empal Daging Kambing',
            'detail' => 'Empal Daging Kambing Dalam Kemasan'
        ]);
        $file = File::create([
            'path' => 'uploads/images/products/variants/mangga.jpg',
        ]);
        $pv1 = ProductVariant::create([
            'product_id' => $product3->uuid,
            'detail' => '[{"name":"Rasa","value":"Mangga"},{"name":"Netto","value":"250 ml"}]',
            'price' => 10000,
            'stock' => 10,
            'image' => $file->uuid
        ]);
        $file = File::create([
            'path' => 'uploads/images/products/variants/coklat.jpg',
        ]);
        $pv2 = ProductVariant::create([
            'product_id' => $product3->uuid,
            'detail' => '[{"name":"Rasa","value":"Coklat"},{"name":"Netto","value":"250 ml"}]',
            'price' => 10000,
            'stock' => 10,
            'image' => $file->uuid
        ]);
        $file = File::create([
            'path' => 'uploads/images/products/variants/melon.jpg',
        ]);
        $pv3 = ProductVariant::create([
            'product_id' => $product3->uuid,
            'detail' => '[{"name":"Rasa","value":"Melon"},{"name":"Netto","value":"250 ml"}]',
            'price' => 10000,
            'stock' => 10,
            'image' => $file->uuid
        ]);
        $file = File::create([
            'path' => 'uploads/images/products/variants/red_velvet.jpg',
        ]);
        $pv4 = ProductVariant::create([
            'product_id' => $product3->uuid,
            'detail' => '[{"name":"Rasa","value":"Red Velvet"},{"name":"Netto","value":"250 ml"}]',
            'price' => 10000,
            'stock' => 10,
            'image' => $file->uuid
        ]);
        $file = File::create([
            'path' => 'uploads/images/products/variants/original.jpg',
        ]);
        $pv5 = ProductVariant::create([
            'product_id' => $product1->uuid,
            'detail' => '[{"name":"Rasa","value":"Original"},{"name":"Netto","value":"250 ml"}]',
            'price' => 12000,
            'stock' => 10,
            'image' => $file->uuid
        ]);
        $file = File::create([
            'path' => 'uploads/images/products/variants/daging.jpg',
        ]);
        $pv6 = ProductVariant::create([
            'product_id' => $product2->uuid,
            'detail' => '[{"name":"Netto","value":"1 kg"}]',
            'price' => 120000,
            'stock' => 10,
            'image' => $file->uuid
        ]);
        $file = File::create([
            'path' => 'uploads/images/products/variants/sate.jpg',
        ]);
        $pv7 = ProductVariant::create([
            'product_id' => $product4->uuid,
            'detail' => '[{"name":"Jumlah","value":"10 Tusuk"}]',
            'price' => 25000,
            'stock' => 10,
            'image' => $file->uuid
        ]);
        $file = File::create([
            'path' => 'uploads/images/products/variants/rendang.jpg',
        ]);
        $pv8 = ProductVariant::create([
            'product_id' => $product5->uuid,
            'detail' => '[{"name":"Netto","value":"200 gr"}]',
            'price' => 65000,
            'stock' => 10,
            'image' => $file->uuid
        ]);
        $file = File::create([
            'path' => 'uploads/images/products/variants/empal.jpg',
        ]);
        $pv9 = ProductVariant::create([
            'product_id' => $product6->uuid,
            'detail' => '[{"name":"Netto","value":"200 ml"}]',
            'price' => 65000,
            'stock' => 10,
            'image' => $file->uuid
        ]);
    }
}
