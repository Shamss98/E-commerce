<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Traits\BulkActionTrait;

class CouponController extends Controller
{
    use BulkActionTrait;
public function index()
{
    $coupons = \App\Models\Coupon::latest()->paginate(10);
    return view('dashboard.coupons.index', compact('coupons'));
}
public function create()
{
    return view('dashboard.coupons.create');
}
public function store(\App\Http\Requests\CouponRequest $request)
{
    // dd($request->all());
    $data = $request->validated();
    \App\Models\Coupon::create($data);
    return redirect()->route('admin.coupons.index')
        ->with('success', 'Coupon created successfully.');
}
public function edit(\App\Models\Coupon $coupon)
{
    $coupon = \App\Models\Coupon::findOrFail($coupon->id);
    return view('backend.coupons.edit', compact('coupon'));
}
public function update(\App\Http\Requests\CouponRequest $request, \App\Models\Coupon $coupon)
{
    $data = $request->validated();
    $coupon->update($data);
    return redirect()->route('admin.coupons.index')
        ->with('success', 'Coupon updated successfully.');

}
public function destroy(\App\Models\Coupon $coupon)
{
    $coupon->delete();
    return redirect()->route('admin.coupons.index')
        ->with('success', 'Coupon deleted successfully.');
}
public function bulkDelete()
{
    $message = $this->ApplyBulkAction(request(), \App\Models\Coupon::class);
    return redirect()->route('admin.coupons.index')->with('success', $message);
}
}
