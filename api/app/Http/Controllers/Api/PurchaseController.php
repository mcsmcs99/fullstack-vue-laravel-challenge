<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PurchaseResource;
use App\Models\Purchase;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    public function index(Request $request)
    {
        $purchases = Purchase::query()
            ->when($request->query('status'), function ($query, $status) {
                $query->where('status', '<>', $status);
            })
            ->orderBy('purchased_at', 'asc')
            ->get();

        return PurchaseResource::collection($purchases);
    }
}
