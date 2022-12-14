<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class AccountResource extends JsonResource {

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
            'id'           => $this -> id,
            'name'         => $this -> name,
            'iban'         => $this -> iban,
            'type'         => $this -> type,
            'balance'      => $this -> balance,
            'createdAt'    => $this -> created_at,
            'updatedAt'    => $this -> updated_at,
            'transactions' => TransactionResource ::collection($this -> whenLoaded('transactions'))
        ];
    }
}
