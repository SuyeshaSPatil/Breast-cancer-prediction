<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Product extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    // Define fillable fields if needed
    protected $fillable = ['name', 'type', 'quantity', 'price'];
    public function transactions() {
        return $this->hasMany(Transaction::class);
    }
}
