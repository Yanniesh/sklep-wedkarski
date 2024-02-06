<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\Relations\BelongsTo;

class Cart extends Model
{
    use HasFactory;
    protected $fillable = ['quantity', 'product_id', 'user_id', 'amount', 'order_id', 'processed'];

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id','id');
    }
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id','id');
    }
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class, 'order_id','id');
    }
}
