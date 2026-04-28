<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InstallmentPlan extends Model
{
    use SoftDeletes;
    protected $table = 'installment_plans';
    protected $fillable = [
        'months',
        'interest_rate',
        'is_active',
    ];
}
