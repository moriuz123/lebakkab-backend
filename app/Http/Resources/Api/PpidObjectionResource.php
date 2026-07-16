<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PpidObjectionResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'ppid_request' => new PpidRequestResource($this->whenLoaded('ppidRequest')),
            'alasan_keberatan' => $this->alasan_keberatan,
            'kasus_posisi' => $this->kasus_posisi,
            'status' => $this->status,
            'catatan_admin' => $this->catatan_admin,
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at->format('Y-m-d H:i:s'),
        ];
    }
}
