<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'cantidad',
        'card_id',
        'payment_method_id',
        'user_id',
        'status_id',
        'total',
    ];

  
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function card()
    {
        return $this->belongsTo(Card::class);
    }

    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }
}
