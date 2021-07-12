<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;


//    protected $table = 'groups';

    public $timestamps = true;

    protected $fillable = [
        'name',
        'money',
        'cost_id',
        'comment',
//        'created_at',
//        'updated_at',
    ];
}
