<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use function PHPSTORM_META\type;

class StoreAccountRequest extends FormRequest {

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
            'name'    => ['required'],
            'type'    => ['required', Rule ::in(['Checking', 'Saving', 'Credit'])],
            'balance' => ['required'],
            'iban'    => ['required']
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'validation.required.name',
            'type.required' => 'validation.required.type',
            'balance.required' => 'validation.required.balance',
            'iban.required' => 'validation.required.iban',
        ];
    }
}
