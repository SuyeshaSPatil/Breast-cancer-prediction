<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TransactionProduct extends Model
{
    protected $fillable = [
        'bill_no', 'product_id', 'price', 'quantity', 'amount', 'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
