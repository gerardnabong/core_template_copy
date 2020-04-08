<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ApiLoginRequest extends FormRequest
{
    public function authorize()
    {
        return false;
    }

    public function rules()
    {
        return [
            'email_address' => 'required|email:rfc',
            'ssn'   => 'required|min:9|numeric',
        ];
    }
}
