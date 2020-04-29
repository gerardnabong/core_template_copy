<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ApiLoginRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = [];
        if ($this->has('hash')) {
            $rules = [
                'hash' => 'required|string|size:77',
            ];
        } else {
            $rules = [
                'email_address' => 'required|email:rfc',
                'ssn'   => 'required|digits:9|numeric',
            ];
        }

        return $rules;
    }
}
