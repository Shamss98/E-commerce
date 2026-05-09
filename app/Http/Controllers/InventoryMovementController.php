<?php

namespace App\Http\Controllers;

use App\Models\InventoryMovement;

class InventoryMovementController extends Controller
{
    public function index()
    {
        $movements = InventoryMovement::with('product', 'user')->latest()->paginate(20);
        return view('dashboard.inventory_movements.index', compact('movements'));
    }

}
