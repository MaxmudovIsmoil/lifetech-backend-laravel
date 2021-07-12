<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupStudent extends Model
{
    use HasFactory;


    protected $table = 'group_students';

    public $timestamps = true;

    protected $fillable = [
        'group_id',
        'student_id',
    ];
}
