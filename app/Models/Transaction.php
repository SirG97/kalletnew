<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id','trx_ref','txn_type','purpose', 'amount', 'balance_before', 'balance_after', 'metadata'
    ];

    protected $casts = [
        'metadata' => 'array'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
