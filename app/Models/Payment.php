<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $fillable = [
        'group_id',
        'student_id',
        'total',
        'month',
        'discount',
        'discount_type',
        'discount_val',
    ];
}
