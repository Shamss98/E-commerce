<?php

namespace App\Services;

use App\Models\Installment;
use App\Models\InstallmentPayment;

use Carbon\Carbon;

class InstallmentService
{

    public function createInstallment($orderId, $userId, $totalAmount, $duration)
    {
        $monthlyAmount = round($totalAmount / $duration, 2);

        // Create Installment Plan
        $installment = Installment::create([
            'order_id' => $orderId,
            'user_id' => $userId,
            'total_amount' => $totalAmount,
            'duration' => $duration,
            'monthly_amount' => $monthlyAmount,
            'status' => 'active',
        ]);

        // Create Payments Schedule
        for ($i = 1; $i <= $duration; $i++) {
            InstallmentPayment::create([
                'installment_id' => $installment->id,
                'amount' => $monthlyAmount,
                'due_date' => Carbon::now()->addMonthsNoOverflow($i),
                'status' => 'pending',
            ]);
        }

        return $installment;
    }

    public function markAsPaid($paymentId)
    {
        $payment = InstallmentPayment::findOrFail($paymentId);

        if ($payment->status === 'paid') {
            return $payment;
        }

        $payment->update([
            'status' => 'paid',
            'paid_at' => now(),
        ]);

        $installment = $payment->installment;

        $remaining = $installment->payments()
            ->where('status', '!=', 'paid')
            ->count();

        if ($remaining == 0) {
            $installment->update([
                'status' => 'completed'
            ]);
        }

        return $payment;
    }

    public function markLatePayments()
    {
        return InstallmentPayment::where('status', 'pending')
            ->whereDate('due_date', '<', now())
            ->update(['status' => 'late']);
    }
}
