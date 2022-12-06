<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateAccountRequest extends FormRequest {

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $user = $this -> user();

        return $user != null && $user -> tokenCan('update');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $method = $this -> method();

        if ($method == "PUT")
        {
            return [
                'name'    => ['required'],
                'type'    => ['required', Rule ::in(['Checking', 'Saving', 'Credit'])],
                'balance' => ['required'],
                'iban'    => ['required']
            ];
        } else
        {
            return [
                'name'    => ['sometimes', 'required'],
                'type'    => ['sometimes', 'required', Rule ::in(['Checking', 'Saving', 'Credit'])],
                'balance' => ['sometimes', 'required'],
                'iban'    => ['sometimes', 'required']
            ];
        }
    }
}
