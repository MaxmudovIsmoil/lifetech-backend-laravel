<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentDetalies extends Model
{
    use HasFactory;

    protected $table = 'payment_detalies';

    public $timestamps = true;

    protected $fillable = [
        'payment_id',
        'paid',
        'payment_type',
    ];
}
