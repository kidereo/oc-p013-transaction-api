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
        $user = $this -> user();

        return $user != null && $user -> tokenCan('create');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'accountId'   => ['required', 'integer'],
            'description' => ['required'],
            'amount'      => ['required', 'numeric'],
            'date'        => ['required', 'date_format:Y-m-d H:i:s'],
            'type'        => ['required', Rule ::in(['Electronic', 'Cash', 'Cheque'])],
            "category"    => ['nullable'],
            "notes"       => ['nullable']
        ];
    }

    protected function prepareForValidation()
    {
        $this -> merge([
            'account_id' => $this -> accountId
        ]);
    }
}
