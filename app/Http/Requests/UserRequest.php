<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        $email = empty(request()->email) ? 0 : request()->email;
        return [
            'name'      =>  'required',
            'email'     =>  'required|string|max:255|unique:users,email,'.$email.',email',
        ];
    }
}
