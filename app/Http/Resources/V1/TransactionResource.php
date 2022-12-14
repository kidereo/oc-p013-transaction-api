<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class TransactionResource extends JsonResource {

    /**
     * The "data" wrapper that should be applied.
     *
     * @var string
     */
    public static $wrap = 'body';

    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        //return parent::toArray($request);
        return [
            'id'          => $this -> id,
            'accountId'   => $this -> account_id,
            'description' => $this -> description,
            'amount'      => $this -> amount,
            'date'        => $this -> date,
            'type'        => $this -> type,
            'category'    => $this -> category,
            'notes'       => $this -> notes,
            'createdAt'   => $this -> created_at,
            'updatedAt'   => $this -> updated_at
        ];
    }
}
