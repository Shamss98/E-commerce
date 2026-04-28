<?php

namespace App\Services\Backend;

use App\Models\InstallmentPlan;

class InstallmentPlanService
{
    public function createInstallment($data)
    {
        $installment = InstallmentPlan::create([
            'months' => $data['months'],
            'interest_rate' => $data['interest_rate'],
            'is_active' => $data['is_active'] ?? true,
        ]);

        return $installment;
    }
    public function updateInstallment(InstallmentPlan $installment, $data)
    {
        $installment->update([
            'months' => $data['months'],
            'interest_rate' => $data['interest_rate'],
            'is_active' => $data['is_active'] ?? true,
        ]);

        return $installment;
    }

}
