<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PurchaseResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'amount' => $this->course->price,
            'status' => $this->status,
            'purchased_at' => $this->purchased_at->format('Y-m-d\TH:i:s'),
            'notes' => $this->notes,
            'customer' => [
                'id' => $this->customer->id,
                'name' => $this->customer->name,
            ],
            'course' => [
                'id' => $this->course->id,
                'title' => $this->course->title,
            ],
        ];
    }
}
