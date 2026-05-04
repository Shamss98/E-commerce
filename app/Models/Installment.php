<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Installment extends Model
{
    protected $table = 'installments';
    protected $fillable = [
        'order_id',
        'user_id',
        'total_amount',
        'duration',
        'monthly_amount',
        'status',
    ];
    public function payments()
    {
        return $this->hasMany(InstallmentPayment::class);
    }
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
