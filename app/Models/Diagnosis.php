<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Diagnosis extends Model
{
    use SoftDeletes;
    protected $fillable = ['patient_id', 'diagnosis_result', 'stage', 'notes'];
    protected $dates = ['deleted_at'];
    // Define the inverse of the relationship, a diagnosis belongs to a user (patient)
    public function user()
    {
        return $this->belongsTo(User::class, 'patient_id');
    }
    public function patient()
{
    return $this->belongsTo(User::class);
}
}
