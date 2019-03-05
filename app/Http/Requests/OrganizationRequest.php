<?php

namespace Printerous\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrganizationRequest extends FormRequest
{
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
            'name' => 'bail|required|unique:organization',
            'email' => 'required|email|unique:organization',
            'phone'=> 'required|numeric|unique:organization',
            'company'=> 'required',
            'website'=> 'required',
            'logo'=> 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'A post name is required',
            'email.required'  => 'A post email is required',
            'phone.required'  => 'A post phone is required',
            'logo.required'  => 'A post logo is required',
            'website.required'  => 'A post website is required',
            'company.required'  => 'A post company is required',
        ];
    }
}
