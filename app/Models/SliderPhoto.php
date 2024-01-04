<?php

namespace App\Models;

use http\Env\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SliderPhoto extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $fillable = [
        'caption',
        'imagePath',
    ];

}
