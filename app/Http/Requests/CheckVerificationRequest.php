<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckVerificationRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'token' => 'required|string|between:50,70',
            'request_code' => 'required',
            'bank_account_number' => 'required|min:5|max:17|regex:/[\d -]+$/',
            'bank_routing_number' => 'required|digits:9|numeric',
        ];
    }
}
