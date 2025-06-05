<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Transaction extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $fillable = ['user_id', 'product_id', 'quantity', 'total_price', 'status'];
    protected $table = 'transaction_products';
    // Define the inverse of the one-to-many relationship (Transaction belongs to Product)
    // public function product()
    // {
    //     return $this->belongsTo(Product::class);
    // }
//     public function products()
// {
//     return $this->hasMany(Product::class,'transaction_id');
// }

// public function products()
// {
//     return $this->belongsToMany(Product::class, 'transaction_product')
//                 ->withPivot('quantity', 'price') // Add any other fields if needed
//                 ->whereNull('deleted_at'); // Ensure soft deletes aren't included
// }

public function products()
    {
        return $this->belongsToMany(Product::class, 'transaction_products', 'transaction_id', 'product_id')
                    ->withPivot('quantity', 'price');
    }
public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Define the one-to-one relationship with the Receipt model
    public function receipt()
    {
        return $this->hasOne(Receipt::class);
    }
}
