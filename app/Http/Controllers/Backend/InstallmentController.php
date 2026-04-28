<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use App\Models\InstallmentPayment;
use App\Services\InstallmentService;

class InstallmentController extends Controller
{
    protected $installmentPayment;
    public function __construct(InstallmentPayment $installmentPayment)
    {
        $this->installmentPayment = $installmentPayment;
    }

public function index()
{
    $installments = \App\Models\Installment::with('payments')->latest()->paginate(10);
    return view('dashboard.installments.index', compact('installments'));
}
public function show(\App\Models\Installment $installment)
{
    $installment->load('payments');
    return view('dashboard.installments.show', compact('installment'));
}
public function destroy(\App\Models\Installment $installment)
{
    $installment->delete();
    return redirect()->route('admin.installments.index')
        ->with('success', 'Installment deleted successfully.');
}
public function pay($id)
{
    $payment = InstallmentPayment::findOrFail($id);
    if ($payment->status == 'paid') {
        return back()->with('error', 'This installment payment is already paid.');
    }
    $payment->update([
        'status' => 'paid',
        'paid_at' => now(),
    ]);

    $installment = $payment->installment;
    $remainingPayments = $installment->payments()->where('status', 'pending')->count();
    if ($remainingPayments == 0) {
        $installment->update(['status' => 'completed']);
    }
    return back()->with('success', 'Installment payment marked as paid.');
}

public function markLate(InstallmentService $service)
{
    $service->markLatePayments();

    return back()->with('success', 'Marked as late');
}
}
