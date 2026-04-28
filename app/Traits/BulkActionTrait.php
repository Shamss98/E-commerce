<?php

namespace App\Traits;

use Illuminate\Http\Request;

trait BulkActionTrait
{
    public function ApplyBulkAction(Request $request, $modelClass, $statusColumn = 'is_active')
    {
    $request->validate([
        'ids' => 'required|array',
        'ids.*' => 'exists:' . (new $modelClass)->getTable() . ',id',
        'action' => 'required|string'
    ]);
    $query = $modelClass::whereIn('id', $request->ids);
    switch ($request->action) {
        case 'delete':
            $query->delete();
            $message = 'Bulk delete performed successfully.';
            break;
        case 'activate':
            $query->update([$statusColumn => 1]);
            $message = 'Bulk activate performed successfully.';
            break;
        case 'deactivate':
            $query->update([$statusColumn => 0]);
            $message = 'Bulk deactivate performed successfully.';
            break;
        default:
            abort(400, 'Invalid action specified.');
    }
    return $message;
    }
}
