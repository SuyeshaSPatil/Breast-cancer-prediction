<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Report extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'title',
        'description',
        'report_date',
        'attachment',
    ];
    public function user()
{
    return $this->belongsTo(User::class, 'student_id');
}

public function student()
{
    return $this->belongsTo(User::class, 'student_id');
}


}    
