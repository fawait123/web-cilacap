<?php

namespace App\Http\Resources;

use App\Models\Paslon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VoteResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $data =  parent::toArray($request);
        $data['paslonData'] = Paslon::select('paslons.*')
            ->selectRaw("(select COALESCE(sum(v.vote),0) from votes v where v.villageID = $this->villageID and v.subdistrictID = $this->subdistrictID and v.pollstationID = $this->id and v.paslonID = paslons.id) vote")
            ->get();

        return $data;
    }
}
