<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\InstallmentPlanRequest;
use App\Models\InstallmentPlan;
use App\Services\Backend\InstallmentPlanService;
use Illuminate\Http\Request;

class InstallmentPlanController extends Controller
{
    use \App\Traits\BulkActionTrait;
    protected $installmentPlanService;
    public function __construct(InstallmentPlanService $installmentPlanService)
    {
        $this->installmentPlanService = $installmentPlanService;
    }
    public function index()
    {
        $plans = \App\Models\InstallmentPlan::latest()->paginate(10);
        return view('dashboard.installment_plans.index', compact('plans'));
    }
    public function create()
    {
        return view('dashboard.installment_plans.create');
    }
    public function store(InstallmentPlanRequest $request)
    {
        $data = $request->validated();
        if (isset($data['is_active'])) {
            $data['is_active'] = true;
        } else {
            $data['is_active'] = false;
        }
        $this->installmentPlanService->createInstallment($data);
        return redirect()->route('admin.installment-plans.index')->with('success', 'Installment plan created successfully.');
    }
    public function edit(\App\Models\InstallmentPlan $installmentPlan)
    {
        return view('dashboard.installment_plans.edit', compact('installmentPlan'));
    }
    public function update(InstallmentPlanRequest $request, InstallmentPlan $installmentPlan)
    {
        $data = $request->validated();
        if (isset($data['is_active'])) {
            $data['is_active'] = true;
        } else {
            $data['is_active'] = false;
        }
        $this->installmentPlanService->updateInstallment($installmentPlan, $data);
        return redirect()->route('admin.installment-plans.index')->with('success', 'Installment plan updated successfully.');
    }
    public function destroy(InstallmentPlan $installmentPlan)
    {
        $installmentPlan->forceDelete();
        return redirect()->route('admin.installment-plans.index')->with('success', 'Installment plan deleted successfully.');
    }
    public function softDelete(InstallmentPlan $installmentPlan)
    {
        $installmentPlan->delete();
        return redirect()->route('admin.installment-plans.index')->with('success', 'Installment plan soft deleted successfully.');
    }
    public function bulkDelete(Request $request)
    {
    $message = $this->ApplyBulkAction($request, InstallmentPlan::class);
    return redirect()->route('admin.installment-plans.index')->with('success', $message);
    }
}
