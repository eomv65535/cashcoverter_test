<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Operacion extends Model
{
    use HasFactory;

    protected $table = 'operacion';

    protected $fillable = [
        'loan_number',
        'client_id',
        'ingress_paid',
        'ingress_bank',
        'ingress_comment',
        'ingress_type',
    ];

    public function loan()
    {
        return $this->belongsTo(Loan::class, 'loan_number');
    }
}
