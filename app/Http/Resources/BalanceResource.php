<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BalanceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'company' => $this->document->category->company['name'],
            'category' => $this->document->category['name'],
            'created_at' => $this->created_at,
            'qty' => $this->qty,
            'debit' => $this->debit,
            'credit' => $this->credit,
            'saldo' => $this->saldo,
        ];
    }
}
