<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateTransactionRequest extends FormRequest {

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
        $method = $this -> method();

        if ($method == "PUT")
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
        } else
        {
            return [
                "accountId"   => ["sometimes", "required"],
                "description" => ["sometimes", "required"],
                "amount"      => ["sometimes", "required"],
                "date"        => ["sometimes", "required"],
                "type"        => ["sometimes", "required", Rule ::in(['Electronic', 'Cash', 'Cheque'])],
                "category"    => ["sometimes"],
                "notes"       => ["sometimes"]
            ];
        }
    }

    protected function prepareForValidation()
    {
        if ($this -> accountId)
        {
            $this -> merge([
                "account_id" => $this -> accountId
            ]);
        }
    }
}
