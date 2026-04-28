<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InstallmentPayment extends Model
{
    protected $table = 'installment_payments';
    protected $fillable = [
        'installment_id',
        'amount',
        'due_date',
        'paid_at',
        'status',
    ];
    public function installment()
    {
        return $this->belongsTo(Installment::class);
    }
}
