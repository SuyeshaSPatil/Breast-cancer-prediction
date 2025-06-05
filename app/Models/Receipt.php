<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Receipt extends Model
{
    use HasFactory;
    protected $fillable = ['transaction_id', 'receipt_number', 'issued_date', 'amount_paid'];
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    // Define the inverse relationship with the Transaction model
    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }
}
