<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['user_id','total','status','address','city','phone_number'];

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
    public function installments()
    {
        return $this->hasMany(Installment::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
