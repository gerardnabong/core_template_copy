<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VerifyBankDetailRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'account_number' => 'required|min:5|max:17|regex:/[\d -]+$/',
            'routing_number'   => 'required|digits:9|numeric',
        ];
    }
}
