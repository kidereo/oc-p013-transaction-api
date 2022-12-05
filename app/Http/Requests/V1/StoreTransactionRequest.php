<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreTransactionRequest extends FormRequest {

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "accountId"   => ["required"],
            "description" => ["required"],
            "amount"      => ["required"],
            "date"        => ["required"],
            "type"        => ["required", Rule ::in(['Electronic', 'Cash', 'Cheque'])],
            "category",
            "notes"
        ];
    }

    protected function prepareForValidation()
    {
        $this -> merge([
            "account_id" => $this -> accountId
        ]);
    }
}
