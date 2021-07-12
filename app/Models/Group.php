<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;


//    protected $table = 'groups';

    public $timestamps = true;

    protected $fillable = [
        'name',
        'course_id',
        'teacher_id',
        'days',
        'time',
        'type',
        'status',
//        'created_at',
//        'updated_at',
    ];
}
