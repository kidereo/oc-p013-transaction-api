<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Resources\Json\ResourceCollection;

class AccountCollection extends ResourceCollection {

    /**
     * The "data" wrapper that should be applied.
     *
     * @var string
     */
    public static $wrap = 'body';

    /**
     * Transform the resource collection into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return parent ::toArray($request);
    }
}
