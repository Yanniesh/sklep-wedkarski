<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categoryData = ['name' => 'Wędki'];
        $category = Category::create($categoryData);

        $subCategories = [
            ['name' => 'Spinningowe', 'category_id' => $category->id],
            ['name' => 'Feederowe', 'category_id' => $category->id],
        ];
        foreach ($subCategories as $subCategory) {
            Category::create($subCategory);
        }
        $categoryData = ['name' => 'Wędki Spławikowe', 'category_id' => $category->id];
        $category = Category::create($categoryData);
        $subCategories = [
            ['name' => 'Bolonki', 'category_id' => $category->id],
            ['name' => 'Matchowe', 'category_id' => $category->id],
            ['name' => 'Baty', 'category_id' => $category->id],
            ['name' => 'Teleskopowe', 'category_id' => $category->id],
        ];
        foreach ($subCategories as $subCategory) {
            Category::create($subCategory);
        }

        $categoryData = ['name' => 'Kołowrotki'];
        $category = Category::create($categoryData);
        $subCategories = [
            ['name' => 'Karpiowe', 'category_id' => $category->id],
            ['name' => 'Z przednim hamulcem', 'category_id' => $category->id],
            ['name' => 'Z tylnym hamulcem', 'category_id' => $category->id],
        ];
        foreach ($subCategories as $subCategory) {
            Category::create($subCategory);
        }
        $categoryData = ['name' => 'Żyłki i plecionki'];
        $category = Category::create($categoryData);
        $subCategories = [
            ['name' => 'Żyłki główne', 'category_id' => $category->id],
            ['name' => 'Żyłki przeponowe', 'category_id' => $category->id],
            ['name' => 'Plecionki', 'category_id' => $category->id],
        ];
        foreach ($subCategories as $subCategory) {
            Category::create($subCategory);
        }
        $categoryData = ['name' => 'Zanęty'];
        $category = Category::create($categoryData);
        $subCategories = [
            ['name' => 'Zanęty', 'category_id' => $category->id],
            ['name' => 'Przynęty', 'category_id' => $category->id],
            ['name' => 'Pellety', 'category_id' => $category->id],
        ];
        foreach ($subCategories as $subCategory) {
            Category::create($subCategory);
        }
        $categoryData = ['name' => 'Przynęty spinningowe'];
        $category = Category::create($categoryData);
        $subCategories = [
            ['name' => 'Wobblery', 'category_id' => $category->id],
            ['name' => 'Przynęty gumowe', 'category_id' => $category->id],
            ['name' => 'Błystki obrotowe', 'category_id' => $category->id],
        ];
        foreach ($subCategories as $subCategory) {
            Category::create($subCategory);
        }
    }
}
