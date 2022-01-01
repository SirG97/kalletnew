<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deposit extends Model
{
    use HasFactory;

    protected $fillable = [
        'trx_ref',
        'amount',
        'email',
        'currency',
        'user_id',
        'status',
    ];

}
