<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RecordResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        if ($this->typeOfamount == 1) {
            return [
                'ID' => $this->id,
                'Amount' => $this->amount,
                'Note' => $this->note,
                'Type' => $this->typeOfamount,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at
            ];
        } else {
            return [
                'ID' => $this->id,
                'Invoice' => $this->invoice,
                'Company' => $this->company,
                'Note' => $this->note,
                'Amount' => $this->amount,
                'Type' => $this->typeOfamount,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at
            ];
        }
    }
}
