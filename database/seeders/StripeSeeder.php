<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Stripe\Stripe;
use Stripe\Product;
use Stripe\Price;

class StripeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Stripe::setApiKey(config('services.stripe.secret'));

        $product = Product::create([
            'name' => 'Nazwa Produktu',
            'type' => 'good', // 'good' dla produktu fizycznego, 'service' dla usługi
        ]);

        // Utwórz cenę dla produktu
        $price = Price::create([
            'product' => $product->id,
            'unit_amount' => 1999, // Cena w centach
            'currency' => 'usd',
        ]);


    }
}
