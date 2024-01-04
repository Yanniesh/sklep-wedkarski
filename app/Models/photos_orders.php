<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class photos_orders extends Model
{
    use HasFactory;
    protected $table = 'photos_orders';
    protected $fillable = ['photos_ids', 'ids_order'];

}

