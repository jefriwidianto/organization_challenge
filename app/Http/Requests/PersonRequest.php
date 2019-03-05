<?php

namespace Printerous\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class PersonRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // $rules = [
        // 'name' => 'bail|required',
        // ];
        // if (request()->isMethod('post')) {
        //     $rules['name'] = 'required|max:10';
        // }
        // if (request()->isMethod('delete')) {
        //     $rules['id'] = 'required|int';
        // }
        // return $rules;
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
            'name' => 'bail|required',
            'email' => 'required|email|unique:person',
            'phone'=> 'required|numeric|unique:person',
            'avatar'=> 'required',
            'id_organization'=> 'required|not_in:0'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'A post name is required',
            'email.required'  => 'A post email is required',
            'phone.required'  => 'A post phone is required',
            'avatar.required'  => 'A post avatar is required',
            'id_organization.required'  => 'A post organization is required',
        ];
    }
}
