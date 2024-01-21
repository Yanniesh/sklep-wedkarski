<?php

namespace Database\Seeders;

use App\Models\photos_orders;
use App\Models\SliderPhoto;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Intervention\Image\Facades\Image;

class SliderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function photoCreate($imagePath): void
    {
        $image = Image::make(public_path("{$imagePath}"))->fit(600, 400);
        $image->save();
        $photo = SliderPhoto::create([
            'caption' => "caption",
            'imagePath' => $imagePath,
        ]);
        $existingOrder = photos_orders::findOrFail(1);
        if (!str_contains($existingOrder->photos_ids, $photo->id)) {
            $jsonArray = json_decode($existingOrder->photos_ids, true);
            $jsonArray[] = $photo->id;
            $existingOrder->update(['photos_ids' => json_encode($jsonArray)]);
        }
    }

    public function run(): void
    {
        photos_orders::create([
            'id' => 1,
            'photos_ids' => json_encode([]),
            'ids_order' => json_encode([]),
        ]);

        $imagePath = 'uploads/Finland_fishing_perch.jpg';
        $this->photoCreate($imagePath);
        $imagePath = 'uploads/Fish-picture.jpg';
        $this->photoCreate($imagePath);
        $imagePath = 'uploads/Fishing-The-Best-Trout-Waters-in-Argentina.jpg';
        $this->photoCreate($imagePath);
        $imagePath = 'uploads/Best-US-Fishing-States-Florida-Captain-Chris-Fishing-Charters.jpg';
        $this->photoCreate($imagePath);
        $imagePath = 'uploads/Do-I-Need-a-Net-for-Fly-Fishing_1200x.jpg';
        $this->photoCreate($imagePath);

        $new_order = ["1","2","3", "4", "5"];
        $slider = photos_orders::query()->find(1);
        $slider->update(['ids_order' => json_encode($new_order)]);
    }


}
