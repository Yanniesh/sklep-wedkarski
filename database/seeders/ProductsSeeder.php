<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductPhoto;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Intervention\Image\Facades\Image;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $productsData = [
            [
                'name' => 'Wędka Westin W2 Powercast 2,48m // 40-130g ',
                'description' => 'Super lekka i wytrzymała.',
                'price' => 419.99,
                'category_id' => 2,
                'user_id' => 1,
            ],
            [
                'name' => 'Wędka Westin W2 Powercast 2,48m // 20-80g',
                'description' => 'Super lekka i wytrzymała.',
                'price' => 379.99,
                'category_id' => 2,
                'user_id' => 1,
            ],
            [
                'name' => 'Wędka Westin W2 Spoon 1,83m // 1-6g',
                'description' => 'Super lekka i wytrzymała.',
                'price' => 359.77,
                'category_id' => 2,
                'user_id' => 1,
            ],
            [
                'name' => 'Wędka Drennan Acolyte Pro Whip 6m',
                'description' => 'Super lekka i wytrzymała.',
                'price' => 999.01,
                'category_id' => 5,
                'user_id' => 1,
            ],
            [
                'name' => 'Wędka Drennan Acolyte Specimen Float 15FT',
                'description' => 'Super lekka i wytrzymała.',
                'price' => 1449.00,
                'category_id' => 5,
                'user_id' => 1,
            ],
            [
                'name' => 'Wędka Matrix Horizon Pro X Waggler 12FT',
                'description' => 'Super lekka i wytrzymała.',
                'price' => 839.00,
                'category_id' => 6,
                'user_id' => 1,
            ],
            [
                'name' => 'Wędka Korum Omega 12FT - 1.5lb',
                'description' => 'Super lekka i wytrzymała.',
                'price' => 799.00,
                'category_id' => 6,
                'user_id' => 1,
            ],
            [
                'name' => 'Wędka Mikado Noctis Pole 6,00',
                'description' => 'Super lekka i wytrzymała.',
                'price' => 263.00,
                'category_id' => 7,
                'user_id' => 1,
            ],
            [
                'name' => 'Wędka Mikado Intro Tele Float 4,00 / 30g',
                'description' => 'Super lekka i wytrzymała.',
                'price' => 105.20,
                'category_id' => 8,
                'user_id' => 1,
            ],
            [
                'name' => 'Wędka Mikado Trython Heavy Tele 3,30 / 160g',
                'description' => 'Super lekka i wytrzymała.',
                'price' => 132.20,
                'category_id' => 8,
                'user_id' => 1,
            ],
            [
                'name' => 'Kołowrotek Mikado Sensual NG Speedrunner 10007',
                'description' => 'Super lekki i wytrzymała.',
                'price' => 236.20,
                'category_id' => 10,
                'user_id' => 1,
            ],
            [
                'name' => 'Kołowrotek Mikado Carp Range 12008',
                'description' => 'Super lekki i wytrzymała.',
                'price' => 151.20,
                'category_id' => 11,
                'user_id' => 1,
            ],
            [
                'name' => 'Kołowrotek Mikado Carp Range 12008',
                'description' => 'Super lekki i wytrzymała.',
                'price' => 131.20,
                'category_id' => 12,
                'user_id' => 1,
            ],
            [
                'name' => 'Żyłka Robinson Pro Feeder 230m - 0,280mm',
                'description' => 'Wytrzymała.',
                'price' => 35.66,
                'category_id' => 14,
                'user_id' => 1,
            ],
            [
                'name' => 'Żyłka Robinson Pro Feeder 230m - 0,260mm',
                'description' => 'Wytrzymała.',
                'price' => 34.66,
                'category_id' => 15,
                'user_id' => 1,
            ],
            [
                'name' => 'Plecionka Westin W3 x8 Braid DUTCH ORANGE 135m - 0.33mm',
                'description' => 'Wytrzymała.',
                'price' => 65.66,
                'category_id' => 16,
                'user_id' => 1,
            ],
            [
                'name' => 'Zanęta Osmo Classic Feeder 900g - Sweet Cage',
                'description' => 'Najlepsza na rynku.',
                'price' => 15.66,
                'category_id' => 18,
                'user_id' => 1,
            ],
            [
                'name' => 'Zanęta Sensas 1kg - 3000 Surface',
                'description' => 'Najlepsza na rynku.',
                'price' => 21.66,
                'category_id' => 18,
                'user_id' => 1,
            ],
            [
                'name' => 'Feeder Bait Burger Wafters 9mm - Epidemia',
                'description' => 'Najlepsza na rynku.',
                'price' => 21.66,
                'category_id' => 19,
                'user_id' => 1,
            ],
            [
                'name' => 'Feeder Bait Burger Wafters 9mm - Orzech Tygrysi',
                'description' => 'Najlepsza na rynku.',
                'price' => 21.66,
                'category_id' => 19,
                'user_id' => 1,
            ],
            [
                'name' => 'Pellet Feeder Bait Method Pellet 2mm - Competition Karp',
                'description' => 'Najlepsza na rynku.',
                'price' => 20.66,
                'category_id' => 20,
                'user_id' => 1,
            ],
            [
                'name' => 'Pellet Feeder Bait Method Pellet 2mm - Mango',
                'description' => 'Najlepsza na rynku.',
                'price' => 21.66,
                'category_id' => 20,
                'user_id' => 1,
            ],
            [
                'name' => 'Wobler Westin Swim Glidebait 8cm SUSPENDING - Real Rudd',
                'description' => 'Najlepsza na rynku.',
                'price' => 51.66,
                'category_id' => 22,
                'user_id' => 1,
            ],
            [
                'name' => 'Wobler Westin Swim Glidebait 8cm SUSPENDING - Real Roach',
                'description' => 'Najlepsza na rynku.',
                'price' => 54.66,
                'category_id' => 22,
                'user_id' => 1,
            ],
            [
                'name' => 'Gumy FishUp Tanta 2.0" - 244 Pumpkin Brown/Orange',
                'description' => 'Najlepsza na rynku.',
                'price' => 24.63,
                'category_id' => 23,
                'user_id' => 1,
            ],
            [
                'name' => 'Mikado Saira 8cm 5 szt. - 560',
                'description' => 'Najlepsza na rynku.',
                'price' => 22.66,
                'category_id' => 23,
                'user_id' => 1,
            ],
            [
                'name' => 'Obrotówka Savage Gear Grub Spinner roz.2 - SILVER RED BLACK',
                'description' => 'Najlepsza na rynku.',
                'price' => 34.56,
                'category_id' => 24,
                'user_id' => 1,
            ],
            [
                'name' => 'Obrotówka Savage Gear Grub Spinner roz.2 - SILVER YELLOW',
                'description' => 'Najlepsza na rynku.',
                'price' => 34.56,
                'category_id' => 24,
                'user_id' => 1,
            ],

        ];


        foreach ($productsData as $productData) {
            $product = Product::create($productData);

            if($product->category_id <= 8 ){
                $path = 'uploads/product/wedka-westin-w2-powercast-248m-40-130g.jpg';
                $photo_data = [
                    'path'=> $path,
                    'product_id' => $product->id];
                ProductPhoto::create($photo_data);
                $image = Image::make(public_path("{$path}"))->fit(600, 400);
                $image->save();
            }
            else if($product->category_id <= 12 ){
                $path = 'uploads/product/pol_pl_Kolowrotek-Savage-Gear-SG8-137111_4.jpg';
                $photo_data = [
                    'path'=> $path,
                    'product_id' => $product->id];
                ProductPhoto::create($photo_data);
                $image = Image::make(public_path("{$path}"))->fit(600, 400);
                $image->save();
            }
            else if($product->category_id <= 16 ){
                $path = 'uploads/product/zylka-guru-drag-line-1000m-028mm-8lb-gdr8-.jpg';
                $photo_data = [
                    'path'=> $path,
                    'product_id' => $product->id];
                ProductPhoto::create($photo_data);
                $image = Image::make(public_path("{$path}"))->fit(600, 400);
                $image->save();
            }
            else if($product->category_id <= 20 ){
                $path = 'uploads/product/zaneta-germina-groundbaits-1-kg.jpg';
                $photo_data = [
                    'path'=> $path,
                    'product_id' => $product->id];
                ProductPhoto::create($photo_data);
                $image = Image::make(public_path("{$path}"))->fit(600, 400);
                $image->save();
            }
            else if($product->category_id == 22 ){
                $path = 'uploads/product/pol_pl_Woblery-Jaxon-HS-Karas-58933_2.jpg';
                $photo_data = [
                    'path'=> $path,
                    'product_id' => $product->id];
                ProductPhoto::create($photo_data);
                $image = Image::make(public_path("{$path}"))->fit(600, 400);
                $image->save();
            }
            else if($product->category_id == 23 ){
                $path = 'uploads/product/przyneta-gumowa-cormoran-action-fin-shad-rtf-13cm29g-golden-seed-2szt.jpg';
                $photo_data = [
                    'path'=> $path,
                    'product_id' => $product->id];
                ProductPhoto::create($photo_data);
                $image = Image::make(public_path("{$path}"))->fit(600, 400);
                $image->save();
            }
            else if($product->category_id == 24 ){
                $path = 'uploads/product/pol_pl_Blystka-obrotowa-Long-nr-2-3159_1.jpg';
                $photo_data = [
                    'path'=> $path,
                    'product_id' => $product->id];
                ProductPhoto::create($photo_data);
                $image = Image::make(public_path("{$path}"))->fit(600, 400);
                $image->save();
            }
        }
    }
}
