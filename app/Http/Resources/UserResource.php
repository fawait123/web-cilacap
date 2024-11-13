<?php

namespace App\Http\Resources;

use App\Models\Regionals;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $data =  parent::toArray($request);
        $data['access'] = $this->role == 'admin' ? Regionals::where('type', 'subdistrict')->get() : Regionals::whereIn('id', json_decode($this->access))->get();

        return $data;
    }
}
