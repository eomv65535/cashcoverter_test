<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'amount',
        'instalments',
        'int_rate',
        'start_date',
    ];

    protected $casts = [
        'start_date' => 'datetime',
    ];

    public function operaciones()
    {
        return $this->hasMany(Operation::class);
    }

}
