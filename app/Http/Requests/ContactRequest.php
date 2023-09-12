<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name'                  => 'required',
            'phone'                 => 'required',
            'email'                 => 'email|required',
        ];
    }

    public function messages()
    {
        return [
            'name.required'         => __('site.wishlistform.name.required'),
            'phone.required'        => __('site.wishlistform.phone.required'),
            'email.required'        => __('site.wishlistform.email.required'),
            'email.email'           => __('site.wishlistform.email.email'),
        ];
    }
}
